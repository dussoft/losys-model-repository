<?php

namespace Referenzverwaltung\Repositories;
use Illuminate\Support\Facades\DB;
use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfConstructionLanguage;

/**
 * Class TypeOfConstructionLanguageRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:23 pm UTC
*/

class TypeOfConstructionLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'typeOfConstrationId',
        'languageId'
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
        return TypeOfConstructionLanguage::class;
    }
    public function createorupdate($condition, $data){
        return TypeOfConstructionLanguage::updateOrCreate($condition, $data);
    }

    public function translate($id, $lang){
        return TypeOfConstructionLanguage::translate($id, $lang);
    }

    public function getLanguagesByTypeId($id){
        return DB::table('type_of_construction_languages')
        ->join('type_of_constructions', 'type_of_constructions.id', '=', 'type_of_construction_languages.typeOfConstrationId')
        ->join('languages', 'languages.id', '=', 'type_of_construction_languages.languageId')
        ->where('type_of_construction_languages.typeOfConstrationId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['type_of_construction_languages.id']);
    }

    public function getByLangAndType($langId, $typeId){
        return TypeOfConstructionLanguage::where('languageId',$langId)->where('typeOfConstrationId', $typeId)->first();
    }
    public function getByTypeiD($typeId){
        return TypeOfConstructionLanguage::where('typeOfConstrationId', $typeId)->get();
    }

    public function getByLanguageId($id){
        return TypeOfConstructionLanguage::where("languageId", $id)->get();
    }
}
