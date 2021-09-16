<?php

namespace App\Presenters\Post;

use App\Transformers\Post\PostTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PostPresenter.
 *
 * @package namespace App\Presenters\Post;
 */
class PostPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PostTransformer();
    }
}
