<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Menu.
 *
 * @package namespace App\Models\Menu;
 */
class Menu extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $table = 'menu';
    public $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function get_child_cate()
    {
        return $this->where('parent_id', $this->id)->orderBy('position')->get();
    }

}
