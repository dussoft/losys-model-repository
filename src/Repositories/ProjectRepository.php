<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\Project;
use Referenzverwaltung\Models\Language;
use Referenzverwaltung\Models\GroupCompany;
use Referenzverwaltung\Models\Address;
use Referenzverwaltung\Models\ProjectParticipatingCompany;
use Referenzverwaltung\Models\TypeOfWork;
use Referenzverwaltung\Models\TypeOfWorkLanguage;
use Referenzverwaltung\Models\ProjectParticipatingCompanyInvolved;
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
 * @package App\Repositories
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

    public function projectQueryBuilder($request,$isIframe=false)
    {
        $query =  Project::whereNotNull('languageId');
        if($request->has('lang')){
            $langShortName=$request->get('lang');
        }else{
            $langShortName=app()->getLocale();
        }
        $lang=Language::where('shortName',$langShortName)->first();
        $query->where('languageId',$lang->id);
        if ($request->has('projectId')) {
            $query->where('id',$request->get('projectId'));
        }else{
            $companyIds = [];
            $companyId = $request->get('companyId');
            if ($request->get('members') && count($request->get('members')) > 0) {
                $memberids = $request->get('members');
                foreach($memberids as $memberid){
                    $companyIds[]=$memberid;
                }
            }
            if ($request->get('groups') && count($request->get('groups')) > 0) {
                $companyIds=GroupCompany::where('groupId',$request->get('groups'))->groupBy('companyId')->pluck('companyId');
            }
            if (count($companyIds) > 0) {
                $query->whereIn('companyId', $companyIds);
            } else {
                $query->where('companyId',  $companyId);
            }
            if ($request->get('text-search')) {

                $fullsearch = $request->get('text-search');
                $words = preg_split('/[\ \n\,]+/', $fullsearch);
                foreach($words as $search){
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
                }

            }

            if ($request->has('text-search-company') && $request->get('text-search-company')) {
                $searchcompany=$request->get('text-search-company');
                $words = preg_split('/[\ \n\,]+/', $searchcompany);
                foreach($words as $search){
                    if(count($companyIds) > 0){
                        $addressIds =  Address::whereIn('companyId', $companyIds)->where('name', 'like',"%{$search}%")->pluck('id');
                    }
                    else{
                        $addressIds =  Address::where('companyId', $request->get('companyId'))->where('name', 'like',"%{$search}%")->pluck('id');
                    }
                    $participatingIds=ProjectParticipatingCompany::whereIn('addressId', $addressIds)->pluck('projectId');
                    $query->whereIn('id', $participatingIds);
                }
            }

            if ($request->has('text-search-work') && $request->get('text-search-work')) {
                $searchWork=$request->get('text-search-work');
                $words = preg_split('/[\ \n\,]+/', $searchWork);
                foreach($words as $search){
                    if(count($companyIds) > 0){
                        $ComptypeOfWorkIds=TypeOfWork::whereIn('companyId', $companyIds)->pluck('id');
                    }
                    else{
                        $ComptypeOfWorkIds=TypeOfWork::where('companyId', $request->get('companyId'))->pluck('id');
                    }
                    $typeWorkLangIds=TypeOfWorkLanguage::whereIn('typeOfWorkId',$ComptypeOfWorkIds)->where('title', 'like',"%{$search}%")->pluck('typeOfWorkId');
                    $projectParticipatingCompanyInvolved=ProjectParticipatingCompanyInvolved::whereIn('typeOfWorkId',$typeWorkLangIds)->pluck('participatingCompanyId');
                    $participatingIds=ProjectParticipatingCompany::whereIn('id', $projectParticipatingCompanyInvolved)->pluck('projectId');
                    $query->whereIn('id', $participatingIds);
                }
            }

            if ($request->get('typeOfConstruction')) {
                $constructions=$request->get('typeOfConstruction');
                if (($key = array_search('0', $constructions)) !== false) {
                    unset($constructions[$key]);
                }
                if(count($constructions)>0){
                    $allconstructions=[];
                    foreach($constructions as $constr){
                        $multipleConstr = preg_split('/[\ \n\,]+/', $constr);
                        foreach($multipleConstr as $singleConstr){
                            $allconstructions[]=$singleConstr;
                        }
                    }
                    $typeOfContructionIds = ProjectTypeOfContruction::whereIn('typeOfContructionId', $allconstructions)->pluck('projectId');
                    $query->whereIn('id', $typeOfContructionIds);
                }
            }

            if ($request->get('typeOfBuilding')) {
                $buildings=$request->get('typeOfBuilding');
                if (($key = array_search('0', $buildings)) !== false) {
                    unset($buildings[$key]);
                }
                if(count($buildings)>0){
                    $allbuild=[];
                    foreach($buildings as $build){
                        $multipleBuild = preg_split('/[\ \n\,]+/', $build);
                        foreach($multipleBuild as $singleBuild){
                            $allbuild[]=$singleBuild;
                        }
                    }
                    $typeOfBuildingIds = ProjectTypeOfBuilding::whereIn('typeOfBuildingId', $allbuild)->pluck('projectId');
                    $query->whereIn('id', $typeOfBuildingIds);
                }
            }

            if ($request->get('canton')) {
                $cantons=$request->get('canton');
                if (($key = array_search('0', $cantons)) !== false) {
                    unset($cantons[$key]);
                }
                if(count($cantons)>0){
                    $query->whereIn('canton', $cantons);
                }
            }
            if (intval($request->get('year_from')) > 0) {
                $query->where('yearOfCompletion','>=', $request->get('year_from'));
            }

            if (intval($request->get('year_to')) > 0) {
                $query->where('yearOfCompletion','<=', $request->get('year_to'));
            }

            if ($request->get('typeOfWork')) {
                $works=$request->get('typeOfWork');
                if (($key = array_search('0', $works)) !== false) {
                    unset($works[$key]);
                }
                if(count($works)>0){
                    $allworks=[];
                    foreach($works as $wrk){
                        $multipleWrk = preg_split('/[\ \n\,]+/', $wrk);
                        foreach($multipleWrk as $singleWrk){
                            $allworks[]=$singleWrk;
                        }
                    }
                    $projectTypeOfWorkprojectIds = ProjectTypeOfWork::whereIn('typeOfWorkId', $allworks)->pluck('projectId');
                    $query->whereIn('id', $projectTypeOfWorkprojectIds);
                }
            }

            if ($request->get('category')) {
                $categories=$request->get('category');
                if (($key = array_search('0', $categories)) !== false) {
                    unset($categories[$key]);
                }
                if(count($categories)>0){
                    $allCateg=[];
                    foreach($categories as $categ){
                        $multipleCateg = preg_split('/[\ \n\,]+/', $categ);
                        foreach($multipleCateg as $singleCateg){
                            $allCateg[]=$singleCateg;
                        }
                    }
                    $projectProjectCategoryIds = ProjectCategory::whereIn('categoryId', $allCateg)->pluck('projectId');
                    $query->whereIn('id', $projectProjectCategoryIds);
                }
            }

            if($request->has('employeeAttribute')){

                if(!empty($request->get('employeeAttribute'))){
                    $employeeAttributes=explode(",",$request->get('employeeAttribute'));
                    $projectIds=[];
                    foreach($employeeAttributes as $employeeAttribute){
                        $valuesInAttribute=explode("_",$employeeAttribute);
                        $employeeAttributeIds=array_slice($valuesInAttribute, 1, count($valuesInAttribute)-2, true);
                        $employeeAttributeValues=explode("-", $valuesInAttribute[count($valuesInAttribute)-1]);

                        if($employeeAttributeIds){
                            $EmpprojectPropertyIds=[];
                            $EmprojectProperties = ProjectProperty::whereIn('projectAttributeId',$employeeAttributeIds)->get();
                            $EmprojectProperties=$EmprojectProperties->whereIn('value', $employeeAttributeValues);
                            foreach( $EmprojectProperties as  $projectProperty){
                                $EmpprojectPropertyIds[]=$projectProperty->projectId;
                            }
                            $query->whereIn('id', $EmpprojectPropertyIds);
                        }
                    }
                }

            }

            $listattributeValue=[];
            $listattributeIds=[];

            if ( !empty( $request->get('attributeValue') )) {
                $indexAttrib=0;
                foreach($request->get('attributeValue') as $attribute){
                    if(isset($request->get('attributeIds')[$indexAttrib]) && isset($request->get('attributeValue')[$indexAttrib]) && $request->get('attributeValue')[$indexAttrib] !=""){
                        $attributeId=$request->get('attributeIds')[$indexAttrib];
                        if($attribute=="LosysNumberAttribute"){
                            if(($request->get('attributeId-from_'.$attributeId) !==null && intval($request->get('attributeId-from_'.$attributeId)) >0)  || ($request->get('attributeId-to_'.$attributeId) !==null && intval($request->get('attributeId-to_'.$attributeId)) > 0) ){
                                $listattributeValue[]=$attribute;
                                $listattributeIds[]=$attributeId;
                            }
                        }
                        else{
                            $listattributeValue[]=$attribute;
                            $listattributeIds[]=$attributeId;
                        }
                    }
                    $indexAttrib++;
                }
            }

            if (isset($listattributeValue) && count($listattributeValue) > 0) {
                $projectPropertyIds=[];
                $i=0;
                $j=0;
                foreach($listattributeValue as $attribute){
                    if(isset($listattributeIds[$i]) && isset($attribute) && $attribute !="" ){
                        $splitAttr=explode("_",$listattributeIds[$i]);
                        $projectProperties = ProjectProperty::whereIn('projectAttributeId',$splitAttr)->get();

                        if($attribute!="LosysNumberAttribute"){

                            $projectProperties = $projectProperties->where('value', $attribute);
                        }
                        else{
                            if($request->get('attributeId-from_'.$listattributeIds[$i]) !==null && intval($request->get('attributeId-from_'.$listattributeIds[$i])) >0){
                                $projectProperties = $projectProperties->where('value','>=', $request->get('attributeId-from_'.$listattributeIds[$i]));
                            }
                            if(($request->get('attributeId-to_'.$listattributeIds[$i]) !==null && intval($request->get('attributeId-to_'.$listattributeIds[$i])) >0)){
                                $projectProperties = $projectProperties->where('value','<=', $request->get('attributeId-to_'.$listattributeIds[$i]));
                            }
                        }

                        if($j==0){
                            foreach( $projectProperties as  $projectProperty){
                                $projectPropertyIds[]=$projectProperty->projectId;
                            }
                        }
                        else{
                            $newIds=[];
                            foreach( $projectProperties as  $projectProperty){
                                $newIds[]=$projectProperty->projectId;
                            }

                            $count=0;
                            foreach($projectPropertyIds as $keptId){
                                if(!in_array($keptId,$newIds))
                                {
                                    unset($projectPropertyIds[$count]);
                                }
                                $count++;
                            }
                        }
                        $j++;
                    }
                    $i++;
                }
                $query->whereIn('id', $projectPropertyIds);
            }
            if($isIframe){
                $query->where(function($query) {
                    $query->where('status', 1)->orWhere('status', 'on');
                });

            }
            $query->where('languageId',$lang->id);
        }
        return $query->with('projectImages')
            ->orderBy('yearOfCompletion', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getFilters($request){
        function filters($request){
            if ($request->get('members') && count($request->get('members')) > 0) {
                $companyId = $request->get('members');
                $companyId[]= $request->get('companyId') ;
                $hasMembers=true;
            }else{
                $companyId = $request->get('companyId');
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
    
            if($request->get('members') && count($request->get('members')) > 0){
                $filterAttributes= ProjectProperty::dataFilter($request->get('members'), true, false);
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
    
    
            $companyId = $request->get('companyId') ;
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

    public function getForPDF($companyIds){
        return Project::whereIn('id', $companyIds)
        ->orderBy('yearOfCompletion', 'DESC')
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getIdsByCompany($companyId){
        return Project::where('companyId', $companyId)->pluck('id');
    }

}
