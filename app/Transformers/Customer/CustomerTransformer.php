<?php

namespace App\Transformers\Customer;

use League\Fractal\TransformerAbstract;
use App\Models\Customer\Customer;

/**
 * Class CustomerTransformer.
 *
 * @package namespace App\Transformers\Customer;
 */
class CustomerTransformer extends TransformerAbstract
{
    /**
     * Transform the Customer entity.
     *
     * @param \App\Models\Customer\Customer $model
     *
     * @return array
     */
    public function transform(Customer $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
