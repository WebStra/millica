<?php

namespace App\Http\Controllers;

use App\Repositories\BasketRepository;
use App\Repositories\ComandRepository;
use App\Repositories\ProductComandRepository;
use App\Repositories\ProductRepository;
use App\PromoCode;
use App\Http\Requests\ComandRequest;
use App\ProductSizes;
use App\PromoCategory;
use Illuminate\Http\Request;
use App\UsedCodes;
use Storage;

/**
 * Class BasketController
 * @package App\Http\Controllers
 */
class BasketController extends Controller
{
    /**
     *
     */
    const PAGINATE = 10;
    /**
     * @var BasketRepository
     */
    protected $basket;

    /**
     * @var ProductRepository
     */
    protected $product;


    /**
     * @var ComandRepository
     */
    protected $comand;

    /**
     * @var ProductComandRepository
     */
    protected $comandproduct;

    /**
     * BasketController constructor.
     * @param BasketRepository $basketRepository
     */
    public function __construct(BasketRepository $basketRepository,
                                ProductRepository $productRepository,
                                ComandRepository $comandRepository,
                                ProductComandRepository $productComandRepository
    )
    {
        $this->comand = $comandRepository;
        $this->basket = $basketRepository;
        $this->product = $productRepository;
        $this->comandproduct = $productComandRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $basketProducts = $this->basket->getByUser(self::PAGINATE);

        ($this->basket->sumProductPrice()) ? $sumPriceProducts = $this->basket->sumProductPrice() : $sumPriceProducts = '0';


        return view('product.basket', compact('basketProducts', 'sumPriceProducts'));
    }


    /**
     * @param Request $request
     * @param $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProduct(Request $request, $product)
    {
        $getBasket = $this->basket->getByCategoryId($product->category_id);

        if ($getBasket) {
            if (!$getBasket->promo_code) {
                $getPrice = $request->quantity * $product->price;
            } else {
                $promoCode = PromoCode::where('code', $getBasket->promo_code)->first();

                if ($promoCode->type == 'bani') {
                    $prodPrice = $product->price - $promoCode->value;
                    $getPrice = $request->quantity * $prodPrice;
                    $promo = $getBasket->promo_code;
                } else {
                    $percent = $product->price / 100;
                    $discountSum = $promoCode->value * $percent;
                    $getPrice = $product->price - $discountSum;
                    $promo = $getBasket->promo_code;
                }
            }
        } else {
            $getPrice = $request->quantity * $product->price;
        }
        $this->basket->addProduct($request->all(), $product, $getPrice, isset($promo) ? $promo : $promo = null);

        $count = count($this->basket->getByUser());

        return response()->json(['succes' => 'succes', 'count' => $count]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id)
    {
        $basketProduct = $this->basket->getById($id);
        if ($basketProduct) {
            $basketProduct->delete();
        }

        return redirect()->back()->with(['message' => 'Produsul a fost sters cu succes!']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBasketProduct(Request $request)
    {
        $getProductId = $this->basket->getSingle($request['item']);
        $getProduct = $this->product->getById($getProductId->product_id);

        $getPromoCode = PromoCode::where('code', $getProductId->promo_code)->first();

        if (!$getProductId->promo_code) {
            $price = $request->count * $getProduct->price;
        } else {
            if ($getPromoCode->type == 'bani') {
                $prodPrice = $getProduct->price - $getPromoCode->value;
                $price = $request->count * $prodPrice;
            } else {
                $totalPrice = $getProduct->price * $request->count;
                $percent = ($getProduct->price * $request->count) / 100;
                $discountSum = $getPromoCode->value * $percent;
                $price = $totalPrice - $discountSum;
            }
        }
        $this->basket->updateCommand($request->all(), $price);

        $sumPrice = $this->basket->sumProductPrice();

        return response()->json(['succes' => 'succes', 'count' => $sumPrice]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public
    function stepTwo()
    {
        ($this->basket->sumProductPrice()) ? $sumPriceProducts = $this->basket->sumProductPrice() : $sumPriceProducts = '0';
        $cityes = $this->sortCity();

        $key = $this->comand->createEmptyComand();

        return view('product.basket.stepTwo', compact('basketProducts', 'sumPriceProducts', 'cityes', 'key'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lastStep(ComandRequest $request)
    {
        if ($request['paymentMethod'] === 'curier') {
            $paid = 'curier';
        } else {
            $paid = 'pending';
        }
        $productFromBasket = $this->basket->getByUser(self::PAGINATE);

        $emptyComand = $this->comand->getByConfirmCode($request['key']);

        foreach ($productFromBasket as $product) {
            $this->comandproduct->addProduct($product, $emptyComand->id);
        }

        ($this->comandproduct->sumProductPrice($emptyComand->id)) ? $sumPriceProducts = $this->comandproduct->sumProductPrice($emptyComand->id) : $sumPriceProducts = '0';

        if ($sumPriceProducts > 200) {
            $price = $sumPriceProducts;
        } else {
            $price = $sumPriceProducts + 15;
        }

        $this->comand->updateEmptyComand($request->all(), $paid, $price);

        $comand = $this->comand->getByConfirmCode($request['key']);

        $basketProducts = $this->comandproduct->getByComandId($comand->id);

        $this->comandPlaced($request['key']);

        return view('product.basket.stepThree', compact('comand', 'basketProducts', 'sumPriceProducts'));

    }


    /**
     * @param $id
     * @return mixed
     */
    public function courierComand($id)
    {
        $this->comandPlaced($id);

        $comand = $this->comand->getByConfirmCode($id);

        return view('product.basket.confirmed', compact('comand'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comandPlaced($id)
    {
        $comand = $this->comand->getByConfirmCode($id);

        $basketProducts = $this->basket->getByUser(self::PAGINATE);

        foreach ($basketProducts as $item) {

            $change = ProductSizes::where('product_id', $item->product_id)->where('title', $item->size)->first();

            $savesize = $change->fill([
                'count' => $change->count - $item->quantity
            ]);

            $savesize->save();

            $item->delete();
        }

        $comand->fill([
            'active' => 1
        ])->save();


    }

    /**
     * @return array
     */
    public function sortCity()
    {
        $sorted = [];
        foreach (\FanCourier::city() as $city) {
            $cityes = $city->judet;
            if (isset($sorted[$cityes])) {
                $sorted[$cityes] = $city->judet;
            } else {
                $sorted[$cityes] = $city->judet;
            }
        }
        return array_values($sorted);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLocationByCity(Request $request)
    {
        $judet = $request->judet;

        if (count($request->judet) > 0) {
            $location = \FanCourier::city(['judet' => $judet, 'language' => 'RO']);
            $sortedLocation = $this->sortLocation($location);
            $rendered = $this->renderLocation($sortedLocation);

            return response()->json($rendered);
        }

    }

    /**
     * @param $sortedLocation
     * @return string
     */
    public function renderLocation($sortedLocation)
    {
        $returnHTML = view('render.location')->with('locations', $sortedLocation)->render();
        return $returnHTML;
    }

    /**
     * @param $locations
     * @return array
     */
    public function sortLocation($locations)
    {
        $sorted = [];

        foreach ($locations as $location) {
            $sorted[] = $location->localitate;
        }
        return array_values($sorted);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function checkPromoCode(Request $request)
    {
        $code = PromoCode::where('code', $request->code)->first();

        $basketProd = $this->basket->getByUserPublic();


        if ($code && \Carbon\Carbon::parse($code->end_date) >= \Carbon\Carbon::now() && \Carbon\Carbon::parse($code->start_date) <= \Carbon\Carbon::now()) {
            if ($code->type == 'bani') {
                $totalSum = $this->ifCodeTypeMoney($basketProd, $code);
                $discount = $code->value . ' RON';
            } else {
                $totalSum = $this->ifCodeTypepercentage($basketProd, $code);
                $discount = $code->value . ' %';
            }

            $used = UsedCodes::where('code', $code->code)->first();

            if ($used) {
                $count = $used->count + 1;
                $refactorCount = $used->fill([
                    'count' => $count
                ]);
                $refactorCount->save();
            } else {
                $savecode = UsedCodes::create([
                    'code' => $code->code,
                    'count' => 1,
                    'active' => 1
                ]);

                $savecode->save();
            }

            return response()->json(['success' => 'success', 'price' => $totalSum, 'discount' => $discount]);
        } else {
            if ($code) {
                if (\Carbon\Carbon::parse($code->end_date) < \Carbon\Carbon::now() && \Carbon\Carbon::parse($code->start_date) <= \Carbon\Carbon::now()) {
                    return response()->json(['expired' => 'expired']);
                } elseif (\Carbon\Carbon::parse($code->start_date) > \Carbon\Carbon::now()) {
                    return response()->json(['start' => 'expired', 'start_date' => $code->start_date]);
                }
            }
            return response()->json(['error' => 'error']);
        }
    }

    /**
     * @param $basketProd
     * @param $code
     * @return mixed
     */
    public function ifCodeTypeMoney($basketProd, $code)
    {
        foreach ($basketProd as $item) {
            $getCategoryPromo = $code->getPromoCategory->where('category_id', $item->getProduct->category_id);
            if (count($getCategoryPromo) > 0) {
                $promoCategoryId = $getCategoryPromo->first()->category_id;
                if ($item->getProduct->category_id == $promoCategoryId) {
                    if ($code->type == 'bani') {
                        if (!$item->promo_code) {
                            $discount = $code->value * $item->quantity;
                            $updateBasket = $item->fill([
                                'price' => $item->price - $discount,
                                'promo_code' => $code->code
                            ]);
                            $updateBasket->save();
                        }
                    }
                }
            } else {
            }
        }
        return $this->basket->sumProductPrice();
    }

    /**
     * @param $basketProd
     * @param $code
     * @return number
     */
    public function ifCodeTypepercentage($basketProd, $code)
    {
        foreach ($basketProd as $item) {
            $getCategoryPromo = $code->getPromoCategory->where('category_id', $item->getProduct->category_id);
            if (count($getCategoryPromo) > 0) {
                $promoCategoryId = $getCategoryPromo->first()->category_id;
                if ($item->getProduct->category_id == $promoCategoryId) {
                    if ($code->type == 'procent') {
                        if (!$item->promo_code) {
                            $percent = $item->price / 100;
                            $discountSum = $code->value * $percent;
                            $discount = $item->price - $discountSum;
                            $updateBasket = $item->fill([
                                'price' => $discount,
                                'promo_code' => $code->code
                            ]);
                            $updateBasket->save();
                        }
                    }
                }
            }
        }
        return $this->basket->sumProductPrice();
    }

}