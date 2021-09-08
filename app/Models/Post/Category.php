<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Models\Post;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const CATE_NAME = 'name';
    const CATE_SLUG = 'slug';
    const CATE_PARENT_ID = 'parent_id';
    const CATE_IMAGE = 'image';
    const CATE_META_TITLE = 'meta_title';
    const CATE_META_DESCRIPTION = 'meta_description';
    const CATE_META_KEYWORD = 'meta_keyword';
    const CATE_TYPE = 'type';
    const CATE_BANNER = 'banner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::CATE_NAME,
        self::CATE_SLUG,
        self::CATE_PARENT_ID,
        self::CATE_IMAGE,
        self::CATE_META_TITLE,
        self::CATE_META_DESCRIPTION,
        self::CATE_META_KEYWORD,
        self::CATE_TYPE,
        self::CATE_BANNER
    ];

    public $dates = ['deleted_at'];

    public $table = 'categories';

    public static function getFieldVietnamese() {
        return [
            self::CATE_SLUG    => trans('field.slug')
        ];
    }

    public function get_child_cate()
    {
        return $this->where( self::CATE_PARENT_ID, $this->id)->get();
    }

    public function getParent()
    {
        return $this->where('id', $this->parent_id)->first();
    }

}
