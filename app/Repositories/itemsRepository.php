<?php

namespace App\Repositories;

use App\Models\items;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class itemsRepository
 * @package App\Repositories
 * @version September 12, 2018, 2:09 pm UTC
 *
 * @method items findWithoutFail($id, $columns = ['*'])
 * @method items find($id, $columns = ['*'])
 * @method items first($columns = ['*'])
*/
class itemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_id',
        'unit_id',
        'size',
        'code',
        'type',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return items::class;
    }
}
