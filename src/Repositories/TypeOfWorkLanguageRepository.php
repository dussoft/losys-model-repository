<?php

namespace Referenzverwaltung\Repositories;
use Illuminate\Support\Facades\DB;
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
        return DB::table('type_of_work_langauages')
        ->join('type_of_works', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
        ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
        ->where('type_of_work_langauages.typeOfWorkId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['type_of_work_langauages.id']);
    }

    

    public function getByLangAndType($langId, $typeId){
        return TypeOfWorkLanguage::where('languageId',$langId)->where('typeOfWorkId', $typeId)->first();
    }
    public function getByTypeiD($typeId){
        return TypeOfWorkLanguage::where('typeOfWorkId', $typeId)->get();
    }

    public function searchWorkids($search){
        return TypeOfWorkLanguage::where('title','LIKE', "%". $this->escape_like($search) ."%")->orderBy('title','ASC')->pluck('typeOfWorkId');
    }

    public function search($text){
        return TypeOfWorkLanguage::search($text);
    }

    public function getByTypeOfWorkId($typeOfWorkId){
        return TypeOfWorkLanguage::where('typeOfWorkId',$typeOfWorkId)->get();
    }

    public function getByLanguageId($id){
        return TypeOfWorkLanguage::where("languageId", $id)->get();
    }

    public function getTypeOfWorkIdFromIdsAndSearch($ComptypeOfWorkIds, $search){
        TypeOfWorkLanguage::whereIn('typeOfWorkId',$ComptypeOfWorkIds)->where('title', 'like',"%". $this->escape_like($search) ."%")->pluck('typeOfWorkId');
    }
    
}

