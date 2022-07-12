<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\GroupRight;

/**
 * Class GroupCompanyRepository
 * @package Referenzverwaltung\Repositories
 * @version January 6, 2021, 9:22 am UTC
*/

class GroupRightRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return GroupRight::class;
    }

    public function getByMemberAndCompany($memberId, $companyId){
        return GroupRight::where('memberId',$memberId)->where('companyId',$companyId)->first();
    }

    
}
