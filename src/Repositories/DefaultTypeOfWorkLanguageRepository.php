<?php

namespace Referenzverwaltung\Repositories;

use Illuminate\Support\Facades\DB;
use Referenzverwaltung\Models\DefaultTypeOfWorkLanguage;


class DefaultTypeOfWorkLanguageRepository extends BaseRepository
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
        return DefaultTypeOfWorkLanguage::class;
    }

    public function getByLangAndTypeOfWorkId($lang, $typeOfWorkId){
        return  DefaultTypeOfWorkLanguage::where('languageId', $lang)->where('typeOfWorkId', $typeOfWorkId)->first();
    }

    public function getByTypeOfWorkId($typeOfWorkId){
        return DefaultTypeOfWorkLanguage::where('typeOfWorkId', $typeOfWorkId)->get();
    }

    public function getLanguagesByTypeId($id){
        return DB::table('default_type_of_work_langauages')
            ->join('default_type_of_works', 'default_type_of_works.id', '=', 'default_type_of_work_langauages.typeOfWorkId')
            ->join('languages', 'languages.id', '=', 'default_type_of_work_langauages.languageId')
            ->where('default_type_of_work_langauages.typeOfWorkId', '=', $id)
            ->orderBy('languages.isDefault', 'DESC')
            ->groupBy(['default_type_of_work_langauages.id']);
    }

    public function getByLanguageId($id){
        return DefaultTypeOfWorkLanguage::where("languageId", $id)->get();
    }
}
