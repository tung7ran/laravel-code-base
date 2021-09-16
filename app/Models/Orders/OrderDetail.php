<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderDetail.
 *
 * @package namespace App\Models\Orders;
 */
class OrderDetail extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'order_detail';
    public $dates = ['deleted_at'];

    const ORDER_ID = 'id_order';
    const PRODUCT_ID = 'id_product';
    const ORDER_PRICE = 'price';
    const ORDER_QTY = 'qty';
    const ORDER_TOTAL = 'total';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::ORDER_ID, self::PRODUCT_ID, self::ORDER_PRICE, self::ORDER_QTY, self::ORDER_TOTAL];

    public static function getFieldVietnamese()
    {
        return [];
    }
}
