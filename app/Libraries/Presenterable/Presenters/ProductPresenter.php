<?php

namespace App\Libraries\Presenterable\Presenters;

/**
 * Class ProductPresenter
 * @package App\Libraries\Presenterable\Presenters
 */
class ProductPresenter extends Presenter
{

    /**
     * @return string
     */
    public function renderTitle()
    {
        return str_limit($this->model->title, 40, $end = '..');
    }

    public function renderFullTitle()
    {
        return $this->model->title;
    }


    public function renderPrice()
    {

        if (!$this->model->old_price) {
            return '<span class="price">' . $this->model->price . 'RON </span>';
        } else {
            return '<span class="old_price">' . $this->model->old_price . ' RON</span>
            <span class="price">' . $this->model->price . ' RON</span>';
        }
    }

    public function renderProductPrice()
    {
        if (!$this->model->old_price) {
            return '<span class="products_price">' . $this->model->price . ' RON</span>';
        } else {
            return '<span class="old_price">' . $this->model->old_price . ' RON</span>
            <span class="products_price">' . $this->model->price . ' RON</span>';
        }
    }

    public function renderCoverImage()
    {
       return $this->model->getImage()->pluck('full_name')->first();
    }

    public function renderImages()
    {
        return $this->model->getImage()->get();
    }
}