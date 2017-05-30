<?php

namespace App\Http\Controllers;

use App\Repositories\FavoriteRepository;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Category;
use App\ProductSizes;
use App\SameProduct;
use App\Product;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{

    /**
     * 20 Items per page
     */
    const PAGINATE = 20;

    /**
     * @var ProductRepository
     */
    protected $product;

    /**
     * @var FavoriteRepository
     */
    protected $favorite;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository,
                                FavoriteRepository $favoriteRepository)
    {
        $this->product = $productRepository;
        $this->favorite = $favoriteRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->product->getProducts(self::PAGINATE);
        $count = $this->product->countProduct();

        return view('product.index', ['products' => $products, 'count' => $count]);
    }

    /**
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getByCategory($category)
    {
        $count = $category->getCategoryProducts()->count();

        return view('product.index', ['products' => $category->getCategoryProducts()->orderBy('id', 'DESC')->paginate(self::PAGINATE), 'actual_category' => $category, 'count' => $count]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSaleProducts()
    {
        $products = $this->product->getSaleProduct(self::PAGINATE);
        $count = $this->product->countSaleProduct();

        return view('product.sale', compact('products', 'count'));
    }

    /**
     * @param $colection
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getByColection($colection)
    {
        $count = $colection->getColectionProducts()->count();

        return view('product.index', ['products' => $colection->getColectionProducts()->paginate(self::PAGINATE), 'count' => $count]);
    }

    /**
     * @param $singleProd
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleProduct($singleProd)
    {
        $sameProducts = SameProduct::where('product_id', $singleProd->id)->get();
        $sameCategory = $this->product->getByCategory($singleProd->category_id);
        $productSizes = ProductSizes::where('product_id', $singleProd->id)->get();

        $productSize = ProductSizes::where('product_id', $singleProd->id)->first();

        return view('product.show', [
            'product' => $singleProd,
            'sameCategory' => $sameCategory,
            'productSizes' => $productSizes,
            'prodSize' => $productSize,
            'sameProducts' => $sameProducts
        ]);
    }

    /**
     * @param Request $request
     * @param null $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function filtres(Request $request, $category = null)
    {
        $array = $request->all();
        unset($array['price']);

        if (isset($request->price)) {
            if (isset($category)) {
                $prod = $this->product->getModel()->withAllTags($array)->where('category_id', $category->id)->where('price', '<=', $request->price)->get();
                $count = count($prod);
            } else {
                $prod = $this->product->getModel()->withAllTags($array)->where('price', '<=', $request->price)->get();
                $count = count($prod);
            }
        } else {
            if (isset($category)) {
                $prod = $this->product->getModel()->withAllTags($array)->where('category_id', $category->id)->get();
                $count = count($prod);
            } else {
                $prod = $this->product->getModel()->withAllTags($array)->get();
                $count = count($prod);
            }
        }

        return response()->json(['products' => $this->htmlFilters($prod), 'count' => $count]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saleFilter(Request $request)
    {
        $array = $request->all();
        unset($array['price']);
        if (isset($request->price)) {
            $prod = $this->product->getModel()->withAllTags($array)->where('old_price', '!=', 0)->where('price', '<=', $request->price)->get();
            $count = count($prod);
        } else {
            $prod = $this->product->getModel()->withAllTags($array)->where('old_price', '!=', 0)->get();
            $count = count($prod);
        }
        return response()->json(['products' => $this->htmlFilters($prod), 'count' => $count]);
    }

    /**
     * @param $products
     * @return string
     */
    public function htmlFilters($products)
    {
        $returnHTML = view('render.product')->with('products', $products)->render();
        return $returnHTML;
    }

    /**
     * @return string
     */
    public function addFavorite(Request $request)
    {
        $checkIfExist = $this->favorite->getById($request->product);

        if ($checkIfExist) {
            $checkIfExist->delete();
            $count = count($this->favorite->getUserFavorites());
            return json_encode(['succes' => 'Produsul a fost sters din lista de favorite!', 'countFavorites' => $count]);
        } else {
            $this->favorite->addProduct($request->product);
            $count = count($this->favorite->getUserFavorites());
            return json_encode(['succes' => 'Produsul a fost adaugat in lista de favorite!', 'countFavorites' => $count]);

        }
    }

    /**
     * @return FavoriteRepository
     */
    public function showFavorite()
    {
        $products = $this->favorite->getUserFavorites(self::PAGINATE);
        return view('product.partials.favorite', compact('products'));
    }


}
