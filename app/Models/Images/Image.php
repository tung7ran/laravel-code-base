<?php

namespace App\Models\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Image.
 *
 * @package namespace App\Models\Images;
 */
class Image extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'image';
    public $dates = ['deleted_at'];

    const IMAGE_NAME  = 'name';
    const IMAGE_TITLE = 'title';
    const IMAGE_IMAGE = 'image';
    const IMAGE_LINK  = 'link';
    const IMAGE_DECS  = 'decs';
    const IMAGE_TYPE  = 'type';
    const IMAGE_STATUS = 'stauts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [self::IMAGE_NAME, self::IMAGE_TITLE, self::IMAGE_IMAGE, self::IMAGE_LINK, self::IMAGE_DECS, self::IMAGE_TYPE, self::IMAGE_STATUS];

    public static function getFieldVietnamese()
    {
        return [];
    }

}
