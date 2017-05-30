<?php
namespace App\Http\ViewComposers;

use App\Sizes;
use App\Colors;
use App\Season;
use App\Aditional;
use Illuminate\Contracts\View\View;

/**
 * Class CategoryComposer
 * @package App\Http\ViewComposers
 */
class FiltersComposer extends Composer
{
    /**
     * @param View $view
     * @return $this
     */
    public function compose(View $view)
    {
        $viewSizes = Sizes::where('active', 1)->get();
        $viewColors = Colors::where('active', 1)->get();
        $viewSeasons = Season::where('active', 1)->get();
        $viewAditional = Aditional::where('active', 1)->get();

        return $view->with([
            'viewSizes' => $viewSizes,
            'viewColors' => $viewColors,
            'viewSeasons' => $viewSeasons,
            'viewAditional' => $viewAditional
        ]);
    }
}