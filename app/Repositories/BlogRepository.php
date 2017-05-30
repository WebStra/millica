<?php

namespace App\Repositories;

use App\Blog;

/**
 * Class BlogRepository
 * @package App\Repositories
 */
class BlogRepository extends Repository
{
    /**
     * @return Blog
     */
    public function getModel()
    {
        return new Blog();
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return self::getModel()
            ->active()
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSinglePost($id)
    {
        return self::getModel()
            ->active()
            ->whereId($id)
            ->first();
    }

    /**
     * @param $id
     * @param int $limit
     * @return mixed
     */
    public function getRelated($id, $limit = 3)
    {
        return self::getModel()
            ->active()
            ->where('id', '!=', $id)
            ->limit($limit)
            ->get();
    }
}
