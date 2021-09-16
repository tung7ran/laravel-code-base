<?php

namespace App\Presenters\Customer;

use App\Transformers\Customer\CustomerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CustomerPresenter.
 *
 * @package namespace App\Presenters\Customer;
 */
class CustomerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CustomerTransformer();
    }
}
