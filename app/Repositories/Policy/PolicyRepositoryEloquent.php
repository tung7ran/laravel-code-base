<?php

namespace App\Repositories\Policy;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Policy\PolicyRepository;
use App\Models\Policy\Policy;
use App\Validators\Policy\PolicyValidator;

/**
 * Class PolicyRepositoryEloquent.
 *
 * @package namespace App\Repositories\Policy;
 */
class PolicyRepositoryEloquent extends BaseRepository implements PolicyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Policy::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PolicyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
