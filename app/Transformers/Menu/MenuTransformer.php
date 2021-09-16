<?php

namespace App\Transformers\Menu;

use League\Fractal\TransformerAbstract;
use App\Models\Menu\Menu;

/**
 * Class MenuTransformer.
 *
 * @package namespace App\Transformers\Menu;
 */
class MenuTransformer extends TransformerAbstract
{
    /**
     * Transform the Menu entity.
     *
     * @param \App\Models\Menu\Menu $model
     *
     * @return array
     */
    public function transform(Menu $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
