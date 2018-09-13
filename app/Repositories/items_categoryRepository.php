<?php

namespace App\Repositories;

use App\Models\items_category;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class items_categoryRepository
 * @package App\Repositories
 * @version September 12, 2018, 1:58 pm UTC
 *
 * @method items_category findWithoutFail($id, $columns = ['*'])
 * @method items_category find($id, $columns = ['*'])
 * @method items_category first($columns = ['*'])
*/
class items_categoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return items_category::class;
    }
}
