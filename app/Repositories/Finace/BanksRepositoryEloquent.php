<?php

namespace App\Repositories\Finace;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Finace\BanksRepository;
use App\Models\Finace\Banks;
use App\Validators\Finace\BanksValidator;

/**
 * Class BanksRepositoryEloquent.
 *
 * @package namespace App\Repositories\Finace;
 */
class BanksRepositoryEloquent extends BaseRepository implements BanksRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Banks::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BanksValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
