<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class orders
 * @package App\Models
 * @version September 22, 2018, 9:59 am UTC
 *
 * @property \App\Models\bills bills
 * @property string order_code
 * @property date order_date
 * @property date shipping_date
 * @property date delivery_date
 * @property string recipient
 * @property string recipient_phone
 * @property string recipient_address
 * @property string pickup_location
 * @property string drop_location
 * @property Integer bill_id
 * @property string status
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
        'order_code' => 'string',
        'order_date' => 'date',
        'shipping_date' => 'date',
        'delivery_date' => 'date',
        'recipient' => 'string',
        'recipient_phone' => 'string',
        'recipient_address' => 'string',
        'pickup_location' => 'string',
        'drop_location' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_code' => 'required',
        'order_date' => 'required',
        'shipping_date' => 'required',
        'delivery_date' => 'required',
        'recipient' => 'required',
        'recipient_phone' => 'required',
        'recipient_address' => 'required',
        'pickup_location' => 'required',
        'drop_location' => 'required',
        'bill_id' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function bills()
    {
        return $this->hasOne(\App\Models\bills::class, 'id', 'bill_id');
    }
}
