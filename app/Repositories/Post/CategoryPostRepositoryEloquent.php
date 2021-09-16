<?php

namespace App\Repositories\Post;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Post\CategoryPostRepository;
use App\Models\Post\CategoryPost;
use App\Validators\Post\CategoryPostValidator;

/**
 * Class CategoryPostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Post;
 */
class CategoryPostRepositoryEloquent extends BaseRepository implements CategoryPostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryPost::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CategoryPostValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
