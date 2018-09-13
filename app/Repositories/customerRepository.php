<?php

namespace App\Repositories;

use App\Models\customer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class customerRepository
 * @package App\Repositories
 * @version September 10, 2018, 12:19 pm UTC
 *
 * @method customer findWithoutFail($id, $columns = ['*'])
 * @method customer find($id, $columns = ['*'])
 * @method customer first($columns = ['*'])
*/
class customerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'phone',
        'remark'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return customer::class;
    }
}
