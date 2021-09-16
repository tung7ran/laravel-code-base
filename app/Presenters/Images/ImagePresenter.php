<?php

namespace App\Presenters\Images;

use App\Transformers\Images\ImageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ImagePresenter.
 *
 * @package namespace App\Presenters\Images;
 */
class ImagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ImageTransformer();
    }
}
