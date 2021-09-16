<?php

namespace App\Transformers\Images;

use League\Fractal\TransformerAbstract;
use App\Models\Images\Image;

/**
 * Class ImageTransformer.
 *
 * @package namespace App\Transformers\Images;
 */
class ImageTransformer extends TransformerAbstract
{
    /**
     * Transform the Image entity.
     *
     * @param \App\Models\Images\Image $model
     *
     * @return array
     */
    public function transform(Image $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
