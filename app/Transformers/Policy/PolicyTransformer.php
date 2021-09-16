<?php

namespace App\Transformers\Policy;

use League\Fractal\TransformerAbstract;
use App\Models\Policy\Policy;

/**
 * Class PolicyTransformer.
 *
 * @package namespace App\Transformers\Policy;
 */
class PolicyTransformer extends TransformerAbstract
{
    /**
     * Transform the Policy entity.
     *
     * @param \App\Models\Policy\Policy $model
     *
     * @return array
     */
    public function transform(Policy $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
