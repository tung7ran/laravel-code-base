<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Models\Orders;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'order';
    public $dates = ['deleted_at'];

    const CUSTOMER_ID  = 'id_customer';
    const ORDER_TYPE   = 'type';
    const TOTAL_PRICE  = 'total_price';
    const ORDER_STATUS = 'stauts';
    const ORDER_NOTE   = 'note';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::CUSTOMER_ID, self::ORDER_TYPE, self::TOTAL_PRICE, self::ORDER_STATUS, self::ORDER_NOTE];

    public static function getFieldVietnamese()
    {
        return [];
    }

}
