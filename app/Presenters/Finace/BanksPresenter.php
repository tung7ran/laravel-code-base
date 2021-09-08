<?php

namespace App\Presenters\Finace;

use App\Transformers\Finace\BanksTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BanksPresenter.
 *
 * @package namespace App\Presenters\Finace;
 */
class BanksPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BanksTransformer();
    }
}
