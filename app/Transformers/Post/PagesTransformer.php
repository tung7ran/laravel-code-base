<?php

namespace App\Transformers\Post;

use League\Fractal\TransformerAbstract;
use App\Models\Post\Pages;

/**
 * Class PagesTransformer.
 *
 * @package namespace App\Transformers;
 */
class PagesTransformer extends TransformerAbstract
{
    /**
     * Transform the Pages entity.
     *
     * @param \App\Models\Post\Pages $model
     *
     * @return array
     */
    public function transform(Pages $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
