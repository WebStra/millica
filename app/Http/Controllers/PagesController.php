<?php
namespace App\Http\Controllers;

use App\Repositories\BlogRepository;
use App\Repositories\PagesRepository;
use Illuminate\Http\Request;
use App\Blog;

/**
 * Class PagesController
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blog;

    /**
     * @var PagesRepository
     */
    protected $page;

    /**
     * PagesController constructor.
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository,
                                PagesRepository $pagesRepository
    )
    {
        $this->blog = $blogRepository;
        $this->page = $pagesRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blogIndex()
    {
        return view('blog.index', ['posts' => $this->blog->getPosts()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blogSingle(Request $request)
    {
        $post = $this->blog->getSinglePost($request->id);
        $related = $this->blog->getRelated($request->id);

        return view('blog.show', compact('post', 'related'));
    }

    /**
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPage($page)
    {
        return view('partials.pages', ['item' => $page]);
    }

    /**
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutPage($page) {

        return view('partials.about', ['item' => $page]);
    }
}