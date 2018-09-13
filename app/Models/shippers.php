<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class shippers
 * @package App\Models
 * @version September 12, 2018, 12:43 pm UTC
 *
 * @property string name
 * @property string phone
 * @property string address
 * @property string remark
 */
class shippers extends Model
{
    use SoftDeletes;

    public $table = 'shippers';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
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
        'phone' => 'required',
        'address' => 'required'
    ];

    
}
