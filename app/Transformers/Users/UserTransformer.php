<?php

namespace App\Transformers\Users;

use League\Fractal\TransformerAbstract;
use App\Models\Users\User;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers\Users;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param \App\Models\Users\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
