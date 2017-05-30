<?php
namespace App\Repositories;

use App\Colection;

/**
 * Class Colection
 * @package App\Repositories
 */
class ColectionRepository extends Repository
{
    /**
     * @return Colection
     */
    public function getModel()
    {
        return new Colection();
    }

    /**
     * @return mixed
     */
    public function getPublic()
    {
        return self::getModel()
            ->active()
            ->get();
    }
}
