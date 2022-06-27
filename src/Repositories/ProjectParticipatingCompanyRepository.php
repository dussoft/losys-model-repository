<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectParticipatingCompany;

/**
 * Class ProjectParticipatingCompanyRepository
 * @package App\Repositories
 * @version December 21, 2020, 8:15 am UTC
*/

class ProjectParticipatingCompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'addressId'
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
        return ProjectParticipatingCompany::class;
    }

    public function migrateProjectParticipatingCompany($company,$newProjectId, $project){
        return ProjectParticipatingCompany::migrateProjectParticipatingCompany($company,$newProjectId, $project);
    }

    public function replicate($id, $cloneProjectId){
        $projectParticipatingCompany=ProjectParticipatingCompany::where("id",$id)->first();
        $cloneProjectParticipatingCompany = $projectParticipatingCompany->replicate();
        $cloneProjectParticipatingCompany->projectId = $cloneProjectId;
        $cloneProjectParticipatingCompany->save();
        return $cloneProjectParticipatingCompany;
    }
}
