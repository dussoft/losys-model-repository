<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\ProjectTypeOfConstruction;

/**
 * Class ProjectTypeOfConstructionRepository
 * @package Referenzverwaltung\Repositories
 * @version February 18, 2021, 8:17 am UTC
*/

class ProjectTypeOfConstructionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'typeOfContructionId'
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
        return ProjectTypeOfConstruction::class;
    }

    public function migrateProjectTypeOfConstruction($data){
        return ProjectTypeOfConstruction::migrateProjectTypeOfConstruction($data);
    }

    public function getByProjectId($projectId){
        return ProjectTypeOfConstruction::where("projectId", $projectId)->get();
    }

    public function replicate($id, $cloneProjectId){
        $projectTypeOfContruction=ProjectTypeOfConstruction::where("id", $id);
        $cloneProjectTypeOfContruction = $projectTypeOfContruction->replicate();
        $cloneProjectTypeOfContruction->projectId = $cloneProjectId;
        $cloneProjectTypeOfContruction->save();
        return $cloneProjectTypeOfContruction;
    }

    public function getConstructionIdsByProject($projectId){
        return ProjectTypeOfConstruction::where('projectId', $projectId)->pluck('typeOfContructionId');
    }

    public function getProjectIdsByConstructions($constructionIds){
        return ProjectTypeOfConstruction::whereIn('typeOfContructionId', $constructionIds)->pluck('projectId');
    }
}
