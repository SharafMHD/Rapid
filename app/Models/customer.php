<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class customer
 * @package App\Models
 * @version September 10, 2018, 12:19 pm UTC
 *
 * @property string name
 * @property string address
 * @property string phone
 * @property string remark
 */
class customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'address',
        'phone',
        'remark',
        'shipper_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'remark' => 'string',
        'shipper_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'address' => 'required',
        'phone' => 'required',
        'shipper_id'=>'required'
    ];

       /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function shippers()
    {
        return $this->belongsTo(\App\Models\shippers::class, 'shipper_id', 'id');
    }
}
