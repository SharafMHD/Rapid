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
class orderdetails extends Model
{
    use SoftDeletes;

    public $table = 'order_details';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'order_id',
        'unit_id',
        'item_id',
        'status',
        'qty',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'qty' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    // public static $rules = [
    //     'billdate' => 'required',
    //     'code' => 'required',
    //     'customer_id' => 'required',
    //     'shipper_id' => 'required',
    //     'user_id' => 'required',
    //     'status' => 'required'
    // ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orders()
    {
        return $this->belongsTo(\App\Models\orders::class, 'order_id', 'id');
    }
    public function items()
    {
        return $this->belongsTo(\App\Models\items::class, 'item_id', 'id');
    }
    public function units()
    {
        return $this->belongsTo(\App\Models\units::class, 'unit_id', 'id');
    }



}
