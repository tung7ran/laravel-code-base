<?php

namespace App\Models\Finace;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Banks.
 *
 * @package namespace App\Models\Finace;
 */
class Banks extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const BANK_NAME = 'name_bank';
    const BANK_ACCOUNT = 'name_account';
    const BANK_NUMBER = 'bank_number';
    const BANK_ADDRESS = 'address';
    const BANK_IMAGE = 'image';
    const BANK_STATUS = 'status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::BANK_NAME, self::BANK_ACCOUNT, self::BANK_NUMBER, self::BANK_ADDRESS, self::BANK_IMAGE, self::BANK_STATUS ];

    public $dates = ['deleted_at'];

    public $table = 'banks';

    public static function getFieldVietnamese() {
        return [
            self::BANK_NAME       => trans('field.name_bank'),
            self::BANK_ACCOUNT    => trans('field.name_account'),
            self::BANK_NUMBER     => trans('field.bank_number'),
            self::BANK_ADDRESS    => trans('field.address'),
        ];
    }
}
