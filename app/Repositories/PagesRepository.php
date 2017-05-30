<?php

namespace App\Repositories;

use App\Page;

/**
 * Class PagesRepository
 * @package App\Repositories
 */
class PagesRepository extends Repository
{
    /**
     * @return Page
     */
    public function getModel()
    {
        return new Page();
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getByType($type)
    {
        return self::getModel()
            ->where('type', $type)
            ->get();
    }

    /**
     * Get pages for footer.
     * Max number of pages is 2 at moment.
     *
     * @return mixed
     */
    public function getHeader($count = 1)
    {
        return self::getModel()
            ->where('show_in_header', 1)
            ->active()
            ->take($count)
            ->get();
    }

}