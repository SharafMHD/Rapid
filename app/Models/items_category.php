<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class items_category
 * @package App\Models
 * @version September 12, 2018, 1:58 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection items
 * @property string name
 * @property string description
 */
class items_category extends Model
{
    use SoftDeletes;

    public $table = 'items_category';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\items::class, 'category_id', 'id');
    }
}
