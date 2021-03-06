<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\ProjectTypeOfBuilding;

/**
 * Class ProjectTypeOfBuildingRepository
 * @package Referenzverwaltung\Repositories
 * @version February 18, 2021, 8:19 am UTC
*/

class ProjectTypeOfBuildingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'typeOfBuildingId',
        'projectId'
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
        return ProjectTypeOfBuilding::class;
    }

    public function migrateProjectTypeOfBuilding($data){
        return ProjectTypeOfBuilding::migrateProjectTypeOfBuilding($data);
    }

    public function getByProjectId($projectId){
        return ProjectTypeOfBuilding::where("projectId", $projectId)->get();
    }

    public function replicate($id, $cloneProjectId){
        $projectTypeOfBuilding = ProjectTypeOfBuilding::where("id", $id)->first();
        $cloneProjectTypeOfBuilding = $projectTypeOfBuilding->replicate();
        $cloneProjectTypeOfBuilding->projectId = $cloneProjectId;
        $cloneProjectTypeOfBuilding->save();
        return $cloneProjectTypeOfBuilding;
    }

    public function getBuildingIdsByProject($projectId){
        return ProjectTypeOfBuilding::where('projectId', $projectId)->pluck('typeOfBuildingId');
    }

    public function getProjectIdsByBuildings($buildingIds){
        return  ProjectTypeOfBuilding::whereIn('typeOfBuildingId', $buildingIds)->pluck('projectId');
    }
}
