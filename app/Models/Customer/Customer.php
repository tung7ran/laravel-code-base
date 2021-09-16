<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Customer.
 *
 * @package namespace App\Models\Customer;
 */
class Customer extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'customer';
    public $dates = ['deleted_at'];

    const CUSTOMER_NAME = 'name';
    const CUSTOMER_PHONE = 'phone';
    const CUSTOMER_EMAIL = 'email';
    const CUSTOMER_ADDRESS = 'address';
    const PROVINCE_ID = 'province_id';
    const DISTRICT_ID = 'district_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::CUSTOMER_NAME, self::CUSTOMER_PHONE, self::CUSTOMER_EMAIL, self::CUSTOMER_ADDRESS, self::PROVINCE_ID, self::DISTRICT_ID];

    public static function getFieldVietnamese() {
        return [
            self::CUSTOMER_NAME => trans('field.customer_name')
        ];
    }
}
