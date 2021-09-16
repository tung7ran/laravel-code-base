<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Option extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'option';
    public $dates = ['deleted_at'];

    const OPTION_TYPE = 'type';
    const OPTION_CONTENT = 'content';
    const OPTION_META = 'meta';
    const CREATED_BY    = 'created_by';
    const UPDATED_BY    = 'updated_by';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::OPTION_TYPE, self::OPTION_CONTENT, self::OPTION_META, self::CREATED_BY, self::UPDATED_BY];

    public static function getFieldVietnamese()
    {
        return [];
    }
}
