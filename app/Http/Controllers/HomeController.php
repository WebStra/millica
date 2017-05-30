<?php

namespace App\Http\Controllers;

use App\Repositories\ColectionRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Slide;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * @var ColectionRepository
     */
    protected $colection;

    /**
     * @var ProductRepository
     */
    protected $product;

    /**
     * HomeController constructor.
     * @param ColectionRepository $colectionRepository
     */
    public function __construct(ColectionRepository $colectionRepository,
                                ProductRepository $productRepository
    )
    {
        $this->colection = $colectionRepository;
        $this->product = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $colection = $this->colection->getPublic();
        $slideHome = Slide::where('active',1)->get();
        $onSale = $this->product->getHomeSales();
        $products = $this->product->getHomeProducts();
        return view('home.home',compact('colection','slideHome','onSale','products'));
    }
}
