<?php

namespace Referenzverwaltung\ModelPhoto\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 * @version November 23, 2021, 5:08 pm UTC
*/

class CategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'companyId',
        'refo_type_of_work_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Category::class;
    }
}
