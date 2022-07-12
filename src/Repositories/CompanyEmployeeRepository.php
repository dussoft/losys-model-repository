<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\CompanyEmployee;

/**
 * Class CompanyEmployeeRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 4:28 pm UTC
*/

class CompanyEmployeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'firstName',
        'lastName',
        'phone',
        'mobile',
        'email',
        'language',
        'userId',
        'companyId'
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
        return CompanyEmployee::class;
    }

    public function createorupdate($condition, $data){
        return CompanyEmployee::updateOrCreate($condition, $data);
    }

    public function getByEmail($email){
        return CompanyEmployee::where('email',$email)->first();
    }

    public function getByCompany($companyId){
        return CompanyEmployee::where('companyId', $companyId)->orderBy('lastName', 'asc')->orderBy('firstName', 'asc')->get();
    }

    public function getActiveByCompany($companyId){
        return CompanyEmployee::where('companyId', $companyId)->where('status', 'Active')->get();
    }

    public function getActiveByIds($ids){
        return CompanyEmployee::whereIn('id', $ids)->get();
    }
}
