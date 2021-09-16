<?php

namespace App\Presenters\Post;

use App\Transformers\Post\CategoryPostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoryPostPresenter.
 *
 * @package namespace App\Presenters\Post;
 */
class CategoryPostPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoryPostTransformer();
    }
}
