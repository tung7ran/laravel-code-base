<?php

namespace App\Transformers\Post;

use League\Fractal\TransformerAbstract;
use App\Models\Post\Category;

/**
 * Class CategoryTransformer.
 *
 * @package namespace App\Transformers\Post;
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the Category entity.
     *
     * @param \App\Models\Post\Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
