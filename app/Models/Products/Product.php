<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Models\Products;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    const PRODUCT_NAME = 'name';
    const PRODUCT_SLUG = 'slug';
    const PRODUCT_DESC = 'desc';
    const PRODUCT_CONTENT = 'content';
    const PRODUCT_CONTENT_USING = 'content_using';
    const PRODUCT_INGREDIENT = 'ingredient';
    const PRODUCT_IMAGE_USE = 'image_use';
    const PRODUCT_IMAGE_CONTENT = 'image_content';
    const PRODUCT_IMAGE_INGREDIENT = 'image_ingredient';
    const PRODUCT_IMAGE = 'image';
    const PRODUCT_PRICE_NEW = 'price_new';
    const PRODUCT_SELL_NUMBER = 'sell_number';
    const PRODUCT_MORE_IMAGE = 'more_image';
    const PRODUCT_HOT = 'hot';
    const PRODUCT_IS_SALE = 'is_sale';
    const PRODUCT_STATUS = 'status';
    const PRODUCT_META_TITLE = 'meta_title';
    const PRODUCT_META_DESCRIPTION = 'meta_description';
    const PRODUCT_META_KEYWORD = 'meta_keyword';
    const PRODUCT_PRICE = 'price';
    const PRODUCT_SALE_PRICE = 'sale_price';
    const PRODUCT_SALE = 'sale';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::PRODUCT_NAME,
        self::PRODUCT_SLUG,
        self::PRODUCT_DESC,
        self::PRODUCT_CONTENT,
        self::PRODUCT_CONTENT_USING,
        self::PRODUCT_INGREDIENT,
        self::PRODUCT_IMAGE_USE,
        self::PRODUCT_IMAGE_CONTENT,
        self::PRODUCT_IMAGE_INGREDIENT,
        self::PRODUCT_IMAGE,
        self::PRODUCT_PRICE_NEW,
        self::PRODUCT_SELL_NUMBER,
        self::PRODUCT_MORE_IMAGE,
        self::PRODUCT_HOT,
        self::PRODUCT_IS_SALE,
        self::PRODUCT_STATUS,
        self::PRODUCT_META_TITLE,
        self::PRODUCT_META_DESCRIPTION,
        self::PRODUCT_META_KEYWORD,
        self::PRODUCT_PRICE,
        self::PRODUCT_SALE_PRICE,
        self::PRODUCT_SALE
    ];

    public $dates = ['deleted_at'];

    public $table = 'product';

    public static function getFieldVietnamese()
    {
        return [];
    }

}
