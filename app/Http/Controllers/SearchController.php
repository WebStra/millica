<?php
namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Product;
/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    /**
     *
     */
    const PAGINATE =20;
    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * SearchController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->products = $productRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request = $request->all();

        $productSearch = Product::search($request['search'])->paginate(self::PAGINATE);

        return view('search.index', ['products'=>$productSearch]);
    }
}