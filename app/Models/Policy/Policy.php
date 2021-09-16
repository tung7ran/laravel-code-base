<?php

namespace App\Models\Policy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Policy.
 *
 * @package namespace App\Models\Policy;
 */
class Policy extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const POLICY_NAME = 'name';
    const POLICY_SLUG = 'slug';
    const POLICY_BANNER = 'banner';
    const POLICY_CONTENT = 'content';
    const POLICY_STATUS = 'status';
    const POLICY_META_TITLE = 'meta_title';
    const POLICY_META_DESCRIPTION = 'meta_description';
    const POLICY_META_KEYWORD = 'meta_keyword';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::POLICY_NAME,
        self::POLICY_SLUG,
        self::POLICY_BANNER,
        self::POLICY_CONTENT,
        self::POLICY_STATUS,
        self::POLICY_META_TITLE,
        self::POLICY_META_DESCRIPTION,
        self::POLICY_META_KEYWORD
    ];

    public $table = 'policy';

}
