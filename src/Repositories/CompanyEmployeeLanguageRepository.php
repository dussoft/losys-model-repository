<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\CompanyEmployeeLanguage;

/**
 * Class CompanyEmployeeRepository
 *
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 4:28 pm UTC
*/

class CompanyEmployeeLanguageRepository extends BaseRepository
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

    public function model()
    {
        return CompanyEmployeeLanguage::class;
    }
    public function createorupdate($condition, $data){
        return CompanyEmployeeLanguage::updateOrCreate($condition, $data);
    }
    public function getByLangAndEmploy($lang, $employeId){
        return CompanyEmployeeLanguage::where('languageId',$lang)->where('employeId',$employeId)->first();
    }
    
    public function getByEmployeeId($id){
        return CompanyEmployeeLanguage::where('employeId',$id)->get();
    }

    public function getByLanguageId($id){
        return CompanyEmployeeLanguage::where("languageId", $id)->get();
    }

    public function create($languageId, $employeId, $function, $education, $skills){
        return CompanyEmployeeLanguage::create([
            'languageId'=>$languageId,
            'employeId'=>$employeId,
            'function'=>$function,
            'education'=>$education,
            'skills'=>$skills
        ]);
    }

    public function update($languageId, $employeId, $function, $education, $skills){
        $employeeLang=CompanyEmployeeLanguage::where('languageId',$languageId)->where('employeId',$employeId)->first();
        if($employeeLang){
            $employeeLang->update([
                'languageId'=>$languageId,
                'employeId'=>$employeId,
                'function'=>$function,
                'education'=>$education,
                'skills'=> $skills
            ]);
        }
        return $employeeLang;
    }
}
