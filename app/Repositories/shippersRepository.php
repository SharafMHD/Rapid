<?php

namespace App\Repositories;

use App\Models\shippers;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class shippersRepository
 * @package App\Repositories
 * @version September 12, 2018, 12:43 pm UTC
 *
 * @method shippers findWithoutFail($id, $columns = ['*'])
 * @method shippers find($id, $columns = ['*'])
 * @method shippers first($columns = ['*'])
*/
class shippersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'phone',
        'address',
        'remark'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return shippers::class;
    }
}
