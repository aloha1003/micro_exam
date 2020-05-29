<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ExchangeRepository;
use App\Models\Exchange;
use App\Validators\ExchangeValidator;

/**
 * Class ExchangeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ExchangeRepositoryEloquent extends BaseRepository implements ExchangeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Exchange::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
