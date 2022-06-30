<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\DefaultTypeOfConstructionLanguage;


class DefaultTypeOfConstructionLangugaeRepository extends BaseRepository
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
        return DefaultTypeOfConstructionLanguage::class;
    }

    public function getByLangAndTypeOfConstructionId($lang, $typeOfConstructionId){
        return  DefaultTypeOfConstructionLanguage::where('languageId', $lang)->where('typeOfConstructionId', $typeOfConstructionId)->first();
    }

    public function getByTypeOfConstructionId($typeOfConstructionId){
        return DefaultTypeOfConstructionLanguage::where('typeOfConstructionId', $typeOfConstructionId)->get();
    }

    public function getLanguagesByTypeId($id){
        return DB::table('default_type_of_construction_lang')
        ->join('default_type_of_constructions', 'default_type_of_constructions.id', '=', 'default_type_of_construction_lang.typeOfConstrationId')
        ->join('languages', 'languages.id', '=', 'default_type_of_construction_lang.languageId')
        ->where('default_type_of_construction_lang.typeOfConstrationId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['default_type_of_construction_lang.id']);
    }

    public function getByLanguageId($id){
        return DefaultTypeOfConstructionLanguage::where("languageId", $id)->get();
    }
}
