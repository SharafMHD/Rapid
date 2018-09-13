<?php

namespace App\Repositories;

use App\Models\countries;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class countriesRepository
 * @package App\Repositories
 * @version September 12, 2018, 12:29 pm UTC
 *
 * @method countries findWithoutFail($id, $columns = ['*'])
 * @method countries find($id, $columns = ['*'])
 * @method countries first($columns = ['*'])
*/
class countriesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return countries::class;
    }
}
