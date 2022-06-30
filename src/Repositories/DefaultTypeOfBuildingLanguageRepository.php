<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\DefaultTypeOfBuildingLanguage;

/**
 * Class DefaultTypeOfBuildingRepository
 * @package App\Repositories
 * @version February 17, 2021, 8:53 am UTC
*/

class DefaultTypeOfBuildingLanguageRepository extends BaseRepository
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
        return DefaultTypeOfBuildingLanguage::class;
    }

    public function getByLangAndTypeOfBuildingId($lang, $typeOfBuildingId){
        return  DefaultTypeOfBuildingLanguage::where('languageId', $lang)->where('typeOfBuildingId', $typeOfBuildingId)->first();
    }

    public function getByTypeOfBuildingId($typeOfBuildingId){
        return DefaultTypeOfBuildingLanguage::where('typeOfBuildingId', $typeOfBuildingId)->get();
    }

    public function getLanguagesByTypeId($id){
        return DB::table('default_type_of_building_languages')
        ->join('default_type_of_buildings', 'default_type_of_buildings.id', '=', 'default_type_of_building_languages.typeOfBuildingId')
        ->join('languages', 'languages.id', '=', 'default_type_of_building_languages.languageId')
        ->where('default_type_of_building_languages.typeOfBuildingId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['default_type_of_building_languages.id']);
    }

    public function getByLanguageId($id){
        return DefaultTypeOfBuildingLanguage::where("languageId", $id)->get();
    }
}
