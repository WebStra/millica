<?php
namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\Contracts\View\View;

/**
 * Class CategoryComposer
 * @package App\Http\ViewComposers
 */
class CategoryComposer extends Composer
{
    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $category = Category::where('active', 1)->get();

        return $view->with('category', $category);
    }
}