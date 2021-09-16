<?php

namespace App\Transformers\Products;

use League\Fractal\TransformerAbstract;
use App\Models\Products\Product;

/**
 * Class ProductTransformer.
 *
 * @package namespace App\Transformers\Products;
 */
class ProductTransformer extends TransformerAbstract
{
    /**
     * Transform the Product entity.
     *
     * @param \App\Models\Products\Product $model
     *
     * @return array
     */
    public function transform(Product $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
