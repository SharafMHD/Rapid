<?php

namespace App\Repositories;

use App\Models\orders;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ordersRepository
 * @package App\Repositories
 * @version September 22, 2018, 9:59 am UTC
 *
 * @method orders findWithoutFail($id, $columns = ['*'])
 * @method orders find($id, $columns = ['*'])
 * @method orders first($columns = ['*'])
*/
class ordersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_code',
        'order_date',
        'shipping_date',
        'delivery_date',
        'recipient',
        'recipient_phone',
        'recipient_address',
        'pickup_location',
        'drop_location',
        'bill_id',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return orders::class;
    }
}
