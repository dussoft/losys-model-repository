<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Category;

/**
 * Class CategoryRepository
 * @package Referenzverwaltung\Repositories
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

    public function getByCompanyExcludeIds($companyId, $ids){
        return Category::whereNotIn('id', $ids)->where('companyId', $companyId)->get();
    }
}
