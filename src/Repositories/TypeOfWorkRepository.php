<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfWork;
use Referenzverwaltung\Models\DefaultTypeOfWork;
use Referenzverwaltung\Models\TypeOfWorkLanguage;
use Referenzverwaltung\Models\DefaultTypeOfWorkLanguage;

/**
 * Class TypeOfWorkRepository
 * @package App\Repositories
 * @version December 19, 2020, 3:49 pm UTC
*/

class TypeOfWorkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return TypeOfWork::class;
    }

    public function saveDefaultForCompany($companyId){
        foreach (DefaultTypeOfWork::get() as $defaultTypeOfWork) {
            $typeOfWork = new TypeOfWork(['companyId' => $companyId]);
            $typeOfWork->save();
            if ($typeOfWork) {
                foreach (DefaultTypeOfWorkLanguage::where('typeOfWorkId', $defaultTypeOfWork->id)->get() as $defaultTypeOfWorkLang) {
                    if ($defaultTypeOfWorkLang) {
                        $typeOfWorkLang = new TypeOfWorkLanguage([
                            'typeOfWorkId' => $typeOfWork->id,
                            'languageId' => $defaultTypeOfWorkLang->languageId,
                            'title' => $defaultTypeOfWorkLang->title
                        ]);
                        $typeOfWorkLang->save();
                    }
                }
            }
        }
    }

    public function getByCompanyAndRefoId($companyId, $refoId){
        return TypeOfWork::where('companyId', $companyId)->where('refo_type_of_work_id', $refoId)->first();
    }

    public function createorupdate($condition, $data){
        return TypeOfWork::updateOrCreate($condition, $data);
    }

    public function participatingCompanyWorkList($projectParticipatingCompanyTypeOfWorkId, $companyId, $lang){
        $typeOfWorks  = TypeOfWork::join('type_of_work_langauages', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
        ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
        ->where('type_of_works.companyId', $companyId)
        ->where('languages.shortName', $lang)
        ->whereNotIn('type_of_works.id',$projectParticipatingCompanyTypeOfWorkId)
        ->orderBy('type_of_work_langauages.title')
            ->get(['type_of_works.*']);
    }

    public function getByCompanyExcludeIdsPaginateOrder($companyId, $ids, $order="desc", $paginate=10){
        return TypeOfWork::where('companyId', $companyId)
                    ->whereNotIn('id',$ids)
                    ->orderBy('updated_at',$order)->paginate($paginate);
    }

    public function getByCompanyExcludeIdsOrder($companyId, $ids, $order="desc"){
        return TypeOfWork::where('companyId',$companyId)
        ->whereNotIn('id',$ids)
        ->orderBy('updated_at',$order)->get();
    }

    public function getByCompanyIncludeIdsPaginateOrder($companyId, $ids, $order="desc", $paginate=10){
        return TypeOfWork::where('companyId', $companyId)
        ->where('id', 'in', $ids)->orderBy('updated_at',$order)->paginate($paginate);
    }

    

    public function getByCompanyAndLang($companyId, $lang){
        return TypeOfWork::join('type_of_work_langauages', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
        ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
        ->where('type_of_works.companyId', $companyId)
        ->where('languages.shortName', $lang)
       ->orderBy('type_of_work_langauages.title')
        ->get(['type_of_works.*']);
    }

    public function searchFromLanguage($companyId, $textSearch, $isSearch=false ){
        $query =  TypeOfWork::where('companyId', $companyId)->orderBy('updated_at','desc');
        if (isset($textSearch)) {
            $search = $textSearch;
            $typeOfWorkLanguageId = TypeOfWorkLanguage::where('title','LIKE', "%". $this->escape_like($search) ."%")->orderBy('title','ASC')->pluck('typeOfWorkId');
            $query =  $query->whereIn('id', $typeOfWorkLanguageId);
        }
        if ($isSearch) {
            $typeOfWorks =  $query->where('companyId',$companyId)->orderBy('updated_at','desc')->get();
        } else {
            $typeOfWorks =  $query->where('companyId', $companyId)->orderBy('updated_at','desc')->paginate(50);
        }
        return $typeOfWorks;
    }

    public function getIdsFromCompanyIds($companyIds){
        return TypeOfWork::whereIn('companyId', $companyIds)->pluck('id');
    }
}
