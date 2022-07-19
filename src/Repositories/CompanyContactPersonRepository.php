<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\CompanyContactPerson;

/**
 * Class CompanyContactPersonRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 4:57 pm UTC
*/

class CompanyContactPersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firstName',
        'name',
        'lastName',
        'function',
        'phone',
        'mobile',
        'email',
        'state',
        'emailOption',
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
        return CompanyContactPerson::class;
    }

    public function getContactPersonLanguage($id){
        return DB::table('employee_langauages')
        ->join('languages', 'languages.id', '=', 'employee_langauages.languageId')
        ->where('employee_langauages.employeId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['employee_langauages.id']);
    }

    public function getByCompanyId($companyId){
        return CompanyContactPerson::where('companyId', $companyId)->first();
    }
    public function getByEmail($email){
        return CompanyContactPerson::where('email', $email)->first();
    }
}
