<?php

namespace App\Transformers\Finace;

use League\Fractal\TransformerAbstract;
use App\Models\Finace\Banks;

/**
 * Class BanksTransformer.
 *
 * @package namespace App\Transformers\Finace;
 */
class BanksTransformer extends TransformerAbstract
{
    /**
     * Transform the Banks entity.
     *
     * @param \App\Models\Finace\Banks $model
     *
     * @return array
     */
    public function transform(Banks $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
