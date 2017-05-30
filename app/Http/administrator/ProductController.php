<?php

namespace App\Http\administrator;

use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use Keyhunter\Administrator\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Auth\Guard AS AuthGuard;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Input;
use App\ProductImage;
use App\ProductSizes;
use App\SameProduct;
use File;
use Response;
use App\Sizes;
use App\Colors;
use App\Season;
use App\Aditional;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $product;

    /**
     * @var ImageRepository
     */
    protected $image;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(Application $application,
                                AuthGuard $user,
                                ProductRepository $productRepository,
                                ImageRepository $imageRepository
    )
    {
        parent::__construct($application, $user);

        $this->product = $productRepository;
        $this->image = $imageRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id = $_REQUEST['id'];
        $getProduct = $this->product->getById($id);
        $categoryProduct = $this->product->getByCategoryAdmin($getProduct->category_id);
        $prodSizes = ProductSizes::where('product_id', $id)->get();
        $sizes = Sizes::where('active', 1)->get();
        $colors = Colors::where('active', 1)->get();
        $season = Season::where('active', 1)->get();
        $aditional = Aditional::where('active', 1)->get();
        $sameProducts = SameProduct::where('product_id', $id)->get();

        return view('vendor.administrator.product.update', compact('sizes', 'colors', 'season', 'aditional', 'prodSizes', 'categoryProduct', 'sameProducts','getProduct'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function addSame(Request $request)
    {
        $product = SameProduct::firstOrNew([
            'product_id' => $request->product_id,
            'this_id' => $request->this_id
        ]);

        $product->save();

        return redirect()->back();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteSame($id)
    {
        SameProduct::where('id', $id)->delete();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function addSizes(Request $request)
    {
        $prodSize = ProductSizes::create([
            'title' => $request->size,
            'count' => $request->quantity,
            'product_id' => $request->product_id,
        ]);

        $prodSize->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     */
    public function updateSize(Request $request){

       $update = ProductSizes::where('id', $request->size_id)->update([
        'count'=>$request->count_size
        ]);

    }

    /**
     * @param $id
     */
    public function deleteSizes($id)
    {
        ProductSizes::where('id', $id)->delete();

        return redirect()->back();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function postUpload($id)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $id);

        return $response;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductImage($id)
    {
        $images = ProductImage::where('product_id', $id)->get(['original_name', 'filename', 'product_id']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'product' => $image->product_id,
                'size' => File::size(public_path() . '/upload/products/' . $image->filename)
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }

    /**
     * @return int
     */
    public function deleteUpload()
    {
        $filename = Input::get('id');

        if (!$filename) {
            return 0;
        }
        $response = $this->image->delete($filename);

        return $response;
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function addFilter(Request $request, $id)
    {
        $product = $this->product->getById($id);
        $product->tag($request->value[0]);
        return response()->json(['succes' => 'Succes']);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function deleteFilter(Request $request, $id)
    {
        $product = $this->product->getById($id);
        $product->untag($request->value[0]);

        return response()->json(['succes' => 'Succes']);
    }

}