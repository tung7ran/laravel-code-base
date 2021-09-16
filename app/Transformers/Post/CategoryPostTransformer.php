<?php

namespace App\Transformers\Post;

use League\Fractal\TransformerAbstract;
use App\Models\Post\CategoryPost;

/**
 * Class CategoryPostTransformer.
 *
 * @package namespace App\Transformers\Post;
 */
class CategoryPostTransformer extends TransformerAbstract
{
    /**
     * Transform the CategoryPost entity.
     *
     * @param \App\Models\Post\CategoryPost $model
     *
     * @return array
     */
    public function transform(CategoryPost $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
