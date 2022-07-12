<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Company;
use Referenzverwaltung\Models\Project;
use Referenzverwaltung\Models\GroupCompany;
use Referenzverwaltung\Models\TypeOfWorkLanguage;
use Referenzverwaltung\Models\ProjectTypeOfContruction;
use Referenzverwaltung\Models\ProjectTypeOfBuilding;
use Referenzverwaltung\Models\ProjectTypeOfWork;
use Referenzverwaltung\Models\ProjectCategory;
use Referenzverwaltung\Models\ProjectProperty;
use Referenzverwaltung\Models\TypeOfConstructionLanguage;
use Referenzverwaltung\Models\TypeOfBuildingLanguage;
use Referenzverwaltung\Models\CategoryLanguage;
use Referenzverwaltung\Models\Canton;

/**
 * Class ProjectRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 5:02 pm UTC
*/

class ProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'address',
        'zipcode',
        'city',
        'geolocationX',
        'geolocationY',
        'status',
        'title',
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
        return Project::class;
    }

    public function autoImport($url){
        $donwloadedContent=Project::downloadProjectByUrl($url);
        if(array_key_exists('company', $donwloadedContent)){
            $refo_company= $donwloadedContent['company'];
            if(array_key_exists('refo_company_id', $refo_company)){
                $company=Company::where('refo_company_id',$refo_company['refo_company_id'])->first();
                if($company){
                    app(MigrateOldDataController::class)->migrateCompanies($donwloadedContent, $company, false);
                    return response()->json(['success' => true]);
                }
            }
        }
    }

    public function migrateProject($company, $project){
        return Project::migrateProject($company, $project);
    }

    public function downloadProjectByUrl($url){
        return Project::downloadProjectByUrl($url);
    }

    public function projectQueryBuilder($projectIds=[], $isIframe=false, $yearFrom="", $yearTo="", $cantons=[],$searchIframe="", $textSearch="", $companyIds=[], $languageId=""  ){
        $query =  Project::where('languageId', $languageId)->whereIn("id", $projectIds);
        if($textSearch){
            $words = preg_split('/[\ \n\,]+/', $textSearch);
            foreach($words as $wrd){
                $search = BaseRepository::escape_like($wrd);
                if(!$isIframe){
                    $query["search"] = $search;
                    $query->where(function($query) use ($search) {
                        $query->where('title', 'LIKE',"%{$search}%")
                                ->orWhere('address', 'LIKE', "%{$search}%")
                                ->orWhere('zipcode', 'LIKE', "%{$search}%")
                                ->orWhere('city', 'LIKE', "%{$search}%")
                                ->orWhere('country', 'LIKE', "%{$search}%")
                                ->orWhereHas('projectProperties', function ($query) use ($search) {
                                    $query->where('value', 'LIKE', "%{$search}%")
                                    ->whereHas('ProjectAttribute', function ($query) use($search){
                                        $query->where('type', 'textarea')->orWhere('type', 'text');
                                    });
                                });
                    });
                }
                else{
                    $query["searchIframe"]=$search;
                    $query->where(function($query) use ($search) {
                        $query->where('title', 'LIKE',"%{$search}%")
                                ->orWhere('address', 'LIKE', "%{$search}%")
                                ->orWhere('zipcode', 'LIKE', "%{$search}%")
                                ->orWhere('city', 'LIKE', "%{$search}%")
                                ->orWhere('country', 'LIKE', "%{$search}%")
                                ->orWhereHas('projectProperties', function ($query) use ($search) {
                                    $query->where('value', 'LIKE', "%{$search}%")
                                    ->whereHas('ProjectAttribute', function ($query) use($search){
                                        $query->where('view_web', 1)->where(function($query){
                                            $query->where('type', 'textarea')->orWhere('type', 'text');
                                        });
                                    });
                                });
                    });
                }
            }
        }
        

        if(!$isIframe){
            $query->where(function($query) use ($search) {
                $query->where('title', 'LIKE',"%{$search}%")
                        ->orWhere('address', 'LIKE', "%{$search}%")
                        ->orWhere('zipcode', 'LIKE', "%{$search}%")
                        ->orWhere('city', 'LIKE', "%{$search}%")
                        ->orWhere('country', 'LIKE', "%{$search}%")
                        ->orWhereHas('projectProperties', function ($query) use ($search) {
                            $query->where('value', 'LIKE', "%{$search}%")
                            ->whereHas('ProjectAttribute', function ($query) use($search){
                                $query->where('type', 'textarea')->orWhere('type', 'text');
                            });
                        });
            });            
        }
        else{
            $query->where(function($query) use ($search) {
                $query->where('title', 'LIKE',"%{$search}%")
                        ->orWhere('address', 'LIKE', "%{$search}%")
                        ->orWhere('zipcode', 'LIKE', "%{$search}%")
                        ->orWhere('city', 'LIKE', "%{$search}%")
                        ->orWhere('country', 'LIKE', "%{$search}%")
                        ->orWhereHas('projectProperties', function ($query) use ($search) {
                            $query->where('value', 'LIKE', "%{$search}%")
                            ->whereHas('ProjectAttribute', function ($query) use($search){
                                $query->where('view_web', 1)->where(function($query){
                                    $query->where('type', 'textarea')->orWhere('type', 'text');
                                });
                            });
                        });
            });
        }

        if ($cantons) 
            $query->whereIn("canton", $cantons);
        if($yearFrom)
            $query->where('yearOfCompletion','>=', $yearFrom);
        if($yearTo)
            $query->where('yearOfCompletion','<=', $yearTo);  
        
        if($isIframe){
            $query->where(function($query) {
                $query->where('status', 1)->orWhere('status', 'on');
            });
        }
        return $query->with('projectImages')
            ->orderBy('yearOfCompletion', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getFilters($members=[], $companyId=""){
        
            if ($members && count($members) > 0) {
                $companyId = $members;
                $companyId[]= $companyId ;
                $hasMembers=true;
            }else{
                $hasMembers=false;
            }
    
            $filterTypeOfWork=[];
            $filterTypeOfConstruction=[];
            $filterTypeOfBuilding=[];
            $filterCategory=[];
            $filterCanton=[];
            $filterYearFrom=[];
            $filterToFrom=[];
            $filterAttributes=[];
            $filterYearFrom[]=['id'=>0,'title'=>trans('language.project.search.year_from')];
            $filterToFrom[]=['id'=>0,'title'=>trans('language.project.search.year_to')];
    
            if($members && count($members) > 0){
                $filterAttributes= ProjectProperty::dataFilter($members, true, false);
            }
            else{
                $filterAttributes= ProjectProperty::dataFilter();
            }
    
            $workLabels=[];
            foreach(ProjectTypeOfWork::data($companyId,$hasMembers) as $typeOfWork){
                $typeOfWorkTranslated = TypeOfWorkLanguage::translate($typeOfWork->id);
                if($typeOfWorkTranslated && $typeOfWorkTranslated->title){
                    if(in_array(strtolower($typeOfWorkTranslated->title),$workLabels)){
                        $pos = array_search(strtolower($typeOfWorkTranslated->title), $workLabels);
                        if ($pos !== FALSE)
                        {
                            $currentvalue=$filterTypeOfWork[$pos];
                            $newValue=$currentvalue['id'].','.$typeOfWork->id;
                            $filterTypeOfWork[$pos]=['id'=>$newValue,'title'=>$typeOfWorkTranslated->title];
                        }
                    }
                    else{
                        $filterTypeOfWork[]=['id'=>$typeOfWork->id,'title'=>$typeOfWorkTranslated->title];
                        $workLabels[]=strtolower($typeOfWorkTranslated->title);
                    }
                }
             }
    
             $constrLabels=[];
             foreach(ProjectTypeOfContruction::data($companyId,$hasMembers) as $typeOfContruction){
    
              $typeOfConstructionTranslated = TypeOfConstructionLanguage::translate($typeOfContruction->id);
    
                if($typeOfConstructionTranslated && $typeOfConstructionTranslated->title){
                    if(in_array(strtolower($typeOfConstructionTranslated->title),$constrLabels)){
                        $pos = array_search(strtolower($typeOfConstructionTranslated->title), $constrLabels);
                        if ($pos !== FALSE)
                        {
                            $currentvalue=$filterTypeOfConstruction[$pos];
                            $newValue=$currentvalue['id'].','.$typeOfContruction->id;
                            $filterTypeOfConstruction[$pos]=['id'=>$newValue,'title'=>$typeOfConstructionTranslated->title];
                        }
                    }
                    else{
                        $filterTypeOfConstruction[]=['id'=>$typeOfContruction->id,'title'=>$typeOfConstructionTranslated->title];
                        $constrLabels[]=strtolower($typeOfConstructionTranslated->title);
                    }
                }
            }
    
            $buildLabels=[];
            foreach(ProjectTypeOfBuilding::data($companyId,$hasMembers) as $typeOfBuilding){
    
                $typeOfBuildingTranslated = TypeOfBuildingLanguage::translate($typeOfBuilding->id);
    
                if($typeOfBuildingTranslated && $typeOfBuildingTranslated->title){
                    if(in_array(strtolower($typeOfBuildingTranslated->title),$buildLabels)){
                        $pos = array_search(strtolower($typeOfBuildingTranslated->title), $buildLabels);
                        if ($pos !== FALSE)
                        {
                            $currentvalue=$filterTypeOfBuilding[$pos];
                            $newValue=$currentvalue['id'].','.$typeOfBuilding->id;
                            $filterTypeOfBuilding[$pos]=['id'=>$newValue,'title'=>$typeOfBuildingTranslated->title];
                        }
                    }
                    else{
                        $filterTypeOfBuilding[]=['id'=>$typeOfBuilding->id,'title'=>$typeOfBuildingTranslated->title];
                        $buildLabels[]=strtolower($typeOfBuildingTranslated->title);
                    }
                }
            }
    
            $categLabels=[];
            foreach(ProjectCategory::data($companyId,$hasMembers) as $category){
    
                $categoryTranslated = CategoryLanguage::translate($category->id);
    
               if($categoryTranslated && $categoryTranslated->title){
                    if(in_array(strtolower($categoryTranslated->title),$categLabels)){
                        $pos = array_search(strtolower($categoryTranslated->title), $categLabels);
                        if ($pos !== FALSE)
                        {
                            $currentvalue=$filterCategory[$pos];
                            $newValue=$currentvalue['id'].','.$category->id;
                            $filterCategory[$pos]=['id'=>$newValue,'title'=>$categoryTranslated->title];
                        }
                    }
                    else{
                        $filterCategory[]=['id'=>$category->id,'title'=>$categoryTranslated->title];
                        $categLabels[]=strtolower($categoryTranslated->title);
                    }
                }
            }
    
            foreach(Project::canton($companyId,$hasMembers) as $short_canton){
                if($short_canton){
                    $canton=Canton::where('short_name', $short_canton)->first();
                    $lan = app()->getLocale();
                    if($canton && ($lan =='en' || $lan =='de' || $lan =='fr' ||$lan =='it')){
                        $title='';
                        if($lan =='en'){
                            $title=$canton->en;
                        }
                        if($lan =='de'){
                            $title=$canton->de;
                        }
                        if($lan =='fr'){
                            $title=$canton->fr;
                        }
                        if($lan =='it'){
                            $title=$canton->en;
                        }
                        $filterCanton[]=['id'=>$short_canton,'title'=>$title];
                    }
                    else{
                        $filterCanton[]=['id'=>$short_canton,'title'=>$short_canton];
                    }
                }
            }
    
            foreach(Project::getYearOfCompletion($companyId,$hasMembers) as $year){
    
                $filterYearFrom[]=['id'=>$year,'title'=>$year];
            }
    
            foreach(Project::getYearOfCompletion($companyId,$hasMembers) as $year){
    
                $filterToFrom[]=['id'=>$year,'title'=>$year];
            }
            $members=[];
            array_push($members,$companyId);
            foreach(GroupCompany::where('companyId',$companyId)->get() as $groupCompany){
                $companiesIds=GroupCompany::where('groupId',$groupCompany->groupId)->groupBy('companyId')->pluck('companyId');
                $companies=Company::whereIn('id',$companiesIds)->groupBy('id')->get();
                foreach($companies as $company){
                    array_push($members, $company->id);
                }
            }
            $members = array_unique($members);
    
            $printHeaderMembers=Company::whereIn('id',$members)->groupBy('id')->get();
            $Workcol = array_column( $filterTypeOfWork, "title" );
            array_multisort( $Workcol, SORT_ASC, SORT_NATURAL|SORT_FLAG_CASE, $filterTypeOfWork);
            array_unshift($filterTypeOfWork, ['id'=>0,'title'=>trans('language.project.search.typeOfWork')]);
    
            $constrCol = array_column( $filterTypeOfConstruction, "title" );
            array_multisort( $constrCol, SORT_ASC, SORT_NATURAL|SORT_FLAG_CASE, $filterTypeOfConstruction);
            array_unshift($filterTypeOfConstruction, ['id'=>0,'title'=>trans('language.project.search.typeOfConstruction')]);
    
            $buildCol = array_column( $filterTypeOfBuilding, "title" );
            array_multisort( $buildCol, SORT_ASC, SORT_NATURAL|SORT_FLAG_CASE, $filterTypeOfBuilding);
            array_unshift($filterTypeOfBuilding, ['id'=>0,'title'=>trans('language.project.search.typeOfBuilding')]);
    
            $categCol = array_column( $filterCategory, "title" );
            array_multisort( $categCol, SORT_ASC, SORT_NATURAL|SORT_FLAG_CASE, $filterCategory);
            array_unshift($filterCategory, ['id'=>0,'title'=>trans('language.project.search.category')]);
    
            $cantonCol = array_column( $filterCanton, "title" );
            array_multisort( $cantonCol, SORT_ASC, SORT_NATURAL|SORT_FLAG_CASE, $filterCanton);
            array_unshift($filterCanton, ['id'=>0,'title'=>trans('language.project.search.canton')]);
    
             return [
              'filterTypeOfWork'=>$filterTypeOfWork,
              'filterTypeOfConstruction'=>$filterTypeOfConstruction,
              'filterTypeOfBuilding'=>$filterTypeOfBuilding,
              'filterCategory'=>$filterCategory,
              'filterCanton'=>$filterCanton,
              'filterYearFrom'=>$filterYearFrom,
              'filterToFrom'=>$filterToFrom,
              'printHeaderMembers'=>$printHeaderMembers,
              'filterAttributes'=>$filterAttributes];
        
    }

    public function getByCompanyIdsAndId($companyIds, $id){
        return Project::whereIn('companyId', $companyIds)->where('id', $id)->first();
    }

    public function replicate($id, $languageId){
        $project= $this->projectRepository->find($id);
        $cloneProject = $project->replicate();
        $cloneProject->parentId = $project->id;
        $cloneProject->languageId = $languageId;
        $cloneProject->save();
        return $cloneProject;
    }

    public function StripProjectDescriptionTag(){
        $projects =  Project::whereNotNull('languageId')->where('description', 'LIKE', '%<%')->get();
        foreach($projects as $project){
            $description=$project->description;
            if($description){
                $trippedDescription=strip_tags($description);
                $project->description=$trippedDescription;
                $project->save();
            }
        }
    }

    public function getWhereLanguageExist(){
        return Project::whereNotNull('languageId')->get();
    }

    public function getByCompanyAndRefo($companyId, $refoId){
        Project::where('companyId',$companyId)->where('refo_project_id', $refoId)->first();
    }

    public function getForPDF($ids){
        return Project::whereIn('id', $ids)
        ->orderBy('yearOfCompletion', 'DESC')
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getProjectsForIds($ids){
        return Project::whereIn('id',$ids)->get();
    }

    public function getIdsByCompany($companyId){
        return Project::where('companyId', $companyId)->pluck('id');
    }

}
