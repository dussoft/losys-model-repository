<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectParticipatingCompanyInvolved;

/**
 * Class ProjectParticipatingCompanyInvolvedRepository
 * @package App\Repositories
 * @version December 21, 2020, 8:18 am UTC
*/

class ProjectParticipatingCompanyInvolvedRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectParticipatingCompanyId',
        'typeOfWorkId'
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
        return ProjectParticipatingCompanyInvolved::class;
    }

    public function getByParticipatingCompanyId($id){
        return ProjectParticipatingCompanyInvolved::where("participatingCompanyId", $id)->get();
    }

    public function getByTypeOfWorkId($id){
        return ProjectParticipatingCompanyInvolved::where("typeOfWork", $id)->get();
    }

    public function getTypeOfWorkIdByParticipatingCompanyId($id){
        return ProjectParticipatingCompanyInvolved::where("participatingCompanyId", $id)->pluck('typeOfWorkId');
    }

    public function replicate($id, $cloneParticCompId){
        $cloneInvolvedCompany = $involved->replicate();
        $cloneInvolvedCompany->participatingCompanyId = $cloneParticCompId;
        $cloneInvolvedCompany->save();
    }

    public function createOrUpdate($cond, $data){
       return ProjectParticipatingCompanyInvolved::updateOrCreate($cond, $data);
    }

    public function getTypeOfWorkIdByParticipatingCompanyIds($ids){
        return ProjectParticipatingCompanyInvolved::whereIn('participatingCompanyId',$ids)->pluck('typeOfWorkId');
    }

    public function getParticipatingCompanyIdFromTypeOfWorkId($typeWorkLangIds){
        return ProjectParticipatingCompanyInvolved::whereIn('typeOfWorkId',$typeWorkLangIds)->pluck('participatingCompanyId');
    }


}
