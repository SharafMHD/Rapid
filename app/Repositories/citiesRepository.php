<?php

namespace App\Repositories;

use App\Models\cities;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class citiesRepository
 * @package App\Repositories
 * @version September 12, 2018, 11:37 am UTC
 *
 * @method cities findWithoutFail($id, $columns = ['*'])
 * @method cities find($id, $columns = ['*'])
 * @method cities first($columns = ['*'])
*/
class citiesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'country_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return cities::class;
    }
}
