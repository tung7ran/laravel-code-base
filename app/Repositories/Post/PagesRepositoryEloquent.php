<?php

namespace App\Repositories\Post;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Post\PagesRepository;
use App\Models\Post\Pages;
use App\Validators\Post\PagesValidator;

/**
 * Class PagesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PagesRepositoryEloquent extends BaseRepository implements PagesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pages::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PagesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
