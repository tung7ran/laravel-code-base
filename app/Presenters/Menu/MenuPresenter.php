<?php

namespace App\Presenters\Menu;

use App\Transformers\Menu\MenuTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MenuPresenter.
 *
 * @package namespace App\Presenters\Menu;
 */
class MenuPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MenuTransformer();
    }
}
