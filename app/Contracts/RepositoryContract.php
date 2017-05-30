<?php
namespace App\Contracts;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryContracts
 * @package App\Contracts
 */
interface RepositoryContract
{
    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @param $slug
     * @return mixed
     */
    public function find($slug);
}