<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Post.
 *
 * @package namespace App\Models\Post;
 */
class Post extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'post';
    public $dates = ['deleted_at'];

    const POST_NAME      = 'name';
    const POST_SLUG      = 'slug';
    const POST_DESC      = 'desc';
    const POST_CONTENT   = 'content';
    const POST_IMAGE     = 'image';
    const POST_TYPE      = 'type';
    const POST_HOT       = 'hot';
    const POST_STATUS    = 'status';
    const POST_META_TITLE       = 'meta_title';
    const POST_META_DESCRIPTION = 'meta_description';
    const POST_META_KEYWORD     = 'meta_keyword';
    const POST_USER_ID          = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::POST_NAME,
        self::POST_SLUG,
        self::POST_DESC,
        self::POST_CONTENT,
        self::POST_IMAGE,
        self::POST_TYPE,
        self::POST_HOT,
        self::POST_STATUS,
        self::POST_META_TITLE,
        self::POST_META_DESCRIPTION,
        self::POST_META_KEYWORD,
        self::POST_USER_ID
    ];

    public function category()
    {
        return $this->belongsToMany('App\Models\Categories', 'post_category', 'id_post', 'id_category');
    }

    public function Author()
    {
        return $this->hasOne('App\User', 'id', self::POST_USER_ID);
    }
}
