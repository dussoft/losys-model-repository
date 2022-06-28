<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectTypeOfContruction;

/**
 * Class ProjectTypeOfContructionRepository
 * @package App\Repositories
 * @version February 18, 2021, 8:17 am UTC
*/

class ProjectTypeOfContructionRepository extends BaseRepository
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
        return ProjectTypeOfContruction::class;
    }

    public function migrateProjectTypeOfConstruction($data){
        return ProjectTypeOfContruction::migrateProjectTypeOfConstruction($data);
    }

    public function getByProjectId($projectId){
        return ProjectTypeOfContruction::where("projectId", $projectId)->get();
    }

    public function replicate($id, $cloneProjectId){
        $projectTypeOfContruction=ProjectTypeOfContruction::where("id", $id);
        $cloneProjectTypeOfContruction = $projectTypeOfContruction->replicate();
        $cloneProjectTypeOfContruction->projectId = $cloneProjectId;
        $cloneProjectTypeOfContruction->save();
        return $cloneProjectTypeOfContruction;
    }

    public function getConstructionIdsByProject($projectId){
        return ProjectTypeOfContruction::where('projectId', $projectId)->pluck('typeOfContructionId');
    }
}
