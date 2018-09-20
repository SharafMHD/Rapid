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
class billdetails extends Model
{
    use SoftDeletes;

    public $table = 'bill_details';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'bill_id',
        'unit_id',
        'item_id',
        'unit_price',
        'total_price',
        'remark',
        'qty',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'total_price' => 'float',
        'unit_price' => 'float',
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
    public function bills()
    {
        return $this->belongsTo(\App\Models\bills::class, 'bill_id', 'id');
    }


}
