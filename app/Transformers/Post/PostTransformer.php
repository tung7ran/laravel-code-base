<?php

namespace App\Transformers\Post;

use League\Fractal\TransformerAbstract;
use App\Models\Post\Post;

/**
 * Class PostTransformer.
 *
 * @package namespace App\Transformers\Post;
 */
class PostTransformer extends TransformerAbstract
{
    /**
     * Transform the Post entity.
     *
     * @param \App\Models\Post\Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
