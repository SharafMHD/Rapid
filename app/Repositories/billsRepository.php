<?php

namespace App\Repositories;

use App\Models\bills;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class billsRepository
 * @package App\Repositories
 * @version September 14, 2018, 2:26 pm UTC
 *
 * @method bills findWithoutFail($id, $columns = ['*'])
 * @method bills find($id, $columns = ['*'])
 * @method bills first($columns = ['*'])
*/
class billsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'billdate',
        'code',
        'customer_id',
        'shipper_id',
        'user_id',
        'status',
        'discount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return bills::class;
    }
}
