<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\ProjectCategory;

/**
 * Class ProjectCategoryRepository
 * @package Referenzverwaltung\Repositories
 * @version December 1, 2021, 1:23 pm UTC
*/

class ProjectCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'categoryId',
        'refo_category_id'
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
        return ProjectCategory::class;
    }

    public function getByProjectId($id){
        return ProjectCategory::where("projectId", $id)->get();
    }

    public function getCategoryIdByProjectId($projectId){
        return ProjectCategory::where('projectId', $projectId)->pluck('categoryId');
    }

    public function getProjectIdsByCategories($categories){
        return ProjectCategory::whereIn('categoryId', $categories)->pluck('projectId');
    }
}
