<?php

namespace App\Repositories;

use App\Models\customers;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class customersRepository
 * @package App\Repositories
 * @version September 12, 2018, 1:11 pm UTC
 *
 * @method customers findWithoutFail($id, $columns = ['*'])
 * @method customers find($id, $columns = ['*'])
 * @method customers first($columns = ['*'])
*/
class customersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'shipper_id',
        'phone',
        'address',
        'remark'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return customers::class;
    }
}
