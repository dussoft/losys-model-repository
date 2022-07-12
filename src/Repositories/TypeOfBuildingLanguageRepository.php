<?php

namespace Referenzverwaltung\Repositories;
use Illuminate\Support\Facades\DB;

use Referenzverwaltung\Models\TypeOfBuildingLanguage;

/**
 * Class TypeOfBuildingLanguageRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 4:07 pm UTC
*/

class TypeOfBuildingLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'typeOfBuildingId',
        'languageId',
        'title'
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
        return TypeOfBuildingLanguage::class;
    }

    public function createorupdate($condition, $data){
        return TypeOfBuildingLanguage::updateOrCreate($condition, $data);
    }

    public function translate($id, $lang){
        return TypeOfBuildingLanguage::translate($id, $lang);
    }

    public function getByLanguageAndBuilding($langId, $typeOfBuildingId){
        return TypeOfBuildingLanguage::where('languageId',$langId)->where('typeOfBuildingId', $typeOfBuildingId)->first();
    }

    public function getByTypeOfBuildingId($typeOfBuilding){
        return TypeOfBuildingLanguage::where('typeOfBuildingId',$typeOfBuilding)->get();
    }

    public function getLanguagesByTypeId($id){
        return DB::table('type_of_building_languages')
        ->join('type_of_buildings', 'type_of_buildings.id', '=', 'type_of_building_languages.typeOfBuildingId')
        ->join('languages', 'languages.id', '=', 'type_of_building_languages.languageId')
        ->where('type_of_building_languages.typeOfBuildingId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['type_of_building_languages.id']);
    }

    public function getByLanguageId($id){
        return TypeOfBuildingLanguage::where("languageId", $id)->get();
    }
    
}
