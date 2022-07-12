<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\ProjectParticipatingCompany;

/**
 * Class ProjectParticipatingCompanyRepository
 * @package Referenzverwaltung\Repositories
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

    public function getWithAddressByProjectId($projectId){
        return ProjectParticipatingCompany::where('projectId', $projectId)->with('address', 'typeOfWorks')->orderBy('orderingId','asc')->get();
    }

    public function getAddessidsByProjectId($projectId){
        return ProjectParticipatingCompany::where('projectId', $projectId)->pluck('addressId');
    }

    public function getByProjectAndOrder($projectId, $orderingId){
        return ProjectParticipatingCompany::where('projectId', $projectId)->where('orderingId', $orderingId )->first();
    }

    public function getByAddressAndProject($addressId, $projectId){
        return ProjectParticipatingCompany::where('addressId',$addressId)->where('projectId',$projectId)->first();
    }

    public function getByProjectIdAndOrder($projectId, $order){
        return ProjectParticipatingCompany::where('projectId', $projectId)->orderBy('orderingId',$order)->get();
    }

    public function getUndisplayed($projectId){
        return ProjectParticipatingCompany::where('projectId',$projectId)->where('view_web',0)->where('view_datenblatt_extern',0)->where('view_datenblatt_intern',0)->get();
    }

    public function getIdsFromProjects($projectIds){
        return ProjectParticipatingCompany::whereIn('projectId',$projectIds)->pluck('id');
    }

    public function getByAddressId($addressId){
        return ProjectParticipatingCompany::where('addressId', $addressId)->get();
    }

    public function getAddressIdsFromProject($projectId){
        return ProjectParticipatingCompany::whereIn('projectId',$projectId)->pluck('addressId');
    }
    public function getProjectIdsFromAddressIds($addressIds){
        return ProjectParticipatingCompany::whereIn('addressId',$addressIds)->pluck('projectId');
    }

    public function getProjectIdFromIds($ids){
        return ProjectParticipatingCompany::whereIn('id', $ids)->pluck('projectId');
    }
}
