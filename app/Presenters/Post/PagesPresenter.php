<?php

namespace App\Presenters\Post;

use App\Transformers\Post\PagesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PagesPresenter.
 *
 * @package namespace App\Presenters;
 */
class PagesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PagesTransformer();
    }
}
