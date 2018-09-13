<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class customers
 * @package App\Models
 * @version September 12, 2018, 1:11 pm UTC
 *
 * @property \App\Models\shippers shippers
 * @property string name
 * @property integer shipper_id
 * @property string phone
 * @property string address
 * @property string remark
 */
class customers extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'shipper_id',
        'phone',
        'address',
        'remark'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'shipper_id' => 'integer',
        'phone' => 'string',
        'address' => 'string',
        'remark' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'shipper_id' => 'required',
        'phone' => 'required',
        'address' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function shippers()
    {
        return $this->belongsTo(\App\Models\shippers::class, 'shipper_id', 'id');
    }
}
