<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\customers;
use App\Models\users;

/**
 * Class bills
 * @package App\Models
 * @version September 14, 2018, 2:26 pm UTC
 *
 * @property mt
 * @property \App\Models\shippers shippers
 * @property \App\Models\users users
 * @property date billdate
 * @property string code
 * @property relation customer_id
 * @property relation shipper_id
 * @property relation user_id
 * @property string status
 * @property float discount
 */
class orders extends Model
{
    use SoftDeletes;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'date',
        'order_code' => 'string',
        'shipping_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_code'=> 'required',
        'order_date'=> 'required',
        'shipping_date'=> 'required',
        'delivery_date'=> 'required',
        'recipient'=> 'required',
        'recipient_phone'=> 'required',
        'recipient_address'=> 'required',
        'pickup_location'=> 'required',
        'drop_location'=> 'required',
        'bill_id'=> 'required',
        'status'=> 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function bills()
    {
        return $this->belongsTo(\App\Models\bills::class, 'bill_id', 'id');
    }

}
