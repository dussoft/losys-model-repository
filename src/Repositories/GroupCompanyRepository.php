<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\GroupCompany;

/**
 * Class GroupCompanyRepository
 * @package Referenzverwaltung\Repositories
 * @version January 6, 2021, 9:22 am UTC
*/

class GroupCompanyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'group_id',
        'company_id',
        'switch'
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
        return GroupCompany::class;
    }

    public function getIdsByCompany($companyId){
        return GroupCompany::where('companyId',$companyId)->pluck('groupId');
    }

    public function getByGroupFixAmount($groupId, $amount){
        return GroupCompany::where('groupId',$groupId)->paginate($amount);
    }

    public function getByCompanyFixAmount($companyId, $amount){
        return GroupCompany::where('companyId',$companyId)->paginate($amount);
    }

    public function getCompaniesFromGroupIds($groupIds){
        GroupCompany::where('groupId',$groupIds)->groupBy('companyId')->pluck('companyId');
    }
}
