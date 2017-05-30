<?php

namespace App\Libraries\Presenterable;

use App\Libraries\Presenterable\Presenters\Presenter;

/**
 * Class Presenterable
 * @package App\Libraries\Presenterable
 */
trait Presenterable
{
    /**
     * Serialize presenter.
     *
     * @return Presenter
     */
    public function scopePresent()
    {
        $presenter = $this->presenter;

        return new $presenter($this);
    }
}