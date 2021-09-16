<?php

namespace App\Transformers\Contact;

use League\Fractal\TransformerAbstract;
use App\Models\Contact\Contact;

/**
 * Class ContactTransformer.
 *
 * @package namespace App\Transformers\Contact;
 */
class ContactTransformer extends TransformerAbstract
{
    /**
     * Transform the Contact entity.
     *
     * @param \App\Models\Contact\Contact $model
     *
     * @return array
     */
    public function transform(Contact $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
