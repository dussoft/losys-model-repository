<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfWorkLanguage;

/**
 * Class TypeOfWorkLanguageRepository
 * @package App\Repositories
 * @version December 19, 2020, 3:55 pm UTC
*/

class TypeOfWorkLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'typeOfWorkId',
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
        return TypeOfWorkLanguage::class;
    }

    public function createorupdate($condition, $data){
        return TypeOfWorkLanguage::updateOrCreate($condition, $data);
    }

    public function translate($id, $lang="en"){
        return TypeOfWorkLanguage::translate($id, $lang);
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
        return TypeOfWorkLanguage::where('languageId',$langId)->where('typeOfWorkId', $typeId)->first();
    }
    public function getByTypeiD($typeId){
        return TypeOfWorkLanguage::where('typeOfWorkId', $typeId)->get();
    }
}

