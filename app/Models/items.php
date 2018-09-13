<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class items
 * @package App\Models
 * @version September 12, 2018, 2:09 pm UTC
 *
 * @property \App\Models\items_category itemsCategory
 * @property \App\Models\units units
 * @property string name
 * @property integer category_id
 * @property integer unit_id
 * @property string size
 * @property string code
 * @property string type
 * @property string description
 */
class items extends Model
{
    use SoftDeletes;

    public $table = 'items';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'category_id',
        'unit_id',
        'size',
        'code',
        'type',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'category_id' => 'integer',
        'unit_id' => 'integer',
        'size' => 'string',
        'code' => 'string',
        'type' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'category_id' => 'required',
        'unit_id' => 'required',
        'size' => 'required',
        'code' => 'required',
        'type' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function itemsCategory()
    {
        return $this->belongsTo(\App\Models\items_category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function units()
    {
        return $this->belongsTo(\App\Models\units::class, 'unit_id', 'id');
    }
}
