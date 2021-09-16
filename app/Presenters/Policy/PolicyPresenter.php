<?php

namespace App\Presenters\Policy;

use App\Transformers\Policy\PolicyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PolicyPresenter.
 *
 * @package namespace App\Presenters\Policy;
 */
class PolicyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PolicyTransformer();
    }
}
