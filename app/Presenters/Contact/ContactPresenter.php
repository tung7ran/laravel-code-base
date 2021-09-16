<?php

namespace App\Presenters\Contact;

use App\Transformers\Contact\ContactTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContactPresenter.
 *
 * @package namespace App\Presenters\Contact;
 */
class ContactPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContactTransformer();
    }
}
