<?php

namespace App\Transformers\Orders;

use League\Fractal\TransformerAbstract;
use App\Models\Orders\Order;

/**
 * Class OrderTransformer.
 *
 * @package namespace App\Transformers\Orders;
 */
class OrderTransformer extends TransformerAbstract
{
    /**
     * Transform the Order entity.
     *
     * @param \App\Models\Orders\Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
