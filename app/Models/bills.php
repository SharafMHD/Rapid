<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class bills extends Model
{
    use SoftDeletes;

    public $table = 'bills';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'billdate',
        'code',
        'customer_id',
        'shipper_id',
        'user_id',
        'status',
        'discount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'billdate' => 'date',
        'code' => 'string',
        'status' => 'string',
        'discount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'billdate' => 'required',
        'code' => 'required',
        'customer_id' => 'required',
        'shipper_id' => 'required',
        'user_id' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function shippers()
    {
        return $this->belongsTo(\App\Models\shippers::class, 'shipper_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function users()
    {
        return $this->belongsTo(\App\Models\users::class, 'user_id', 'id');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function customers()
    {
        return $this->belongsTo(\App\Models\custmers::class, 'customer_id', 'id');
    }
}
