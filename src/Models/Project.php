<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 * @package App\Models
 * @version December 19, 2020, 5:02 pm UTC
 *
 * @property \App\Models\Company $company
 * @property string $address
 * @property string $zipcode
 * @property string $city
 * @property string $geolocationX
 * @property string $geolocationY
 * @property string $status
 * @property string $title
 * @property integer $companyId
 */
class Project extends Model
{

    public $table = 'projects';
    use SoftDeletes;



    public $fillable = [
        'address',
        'zipcode',
        'city',
        'geolocationX',
        'geolocationY',
        'status',
        'title',
        'companyId',
        'yearOfCompletion',
        'description',
        'projectWebsite',
        'visibilityOption',
        'country',
        'languageId',
        'parentId',
        'canton',
        'refo_project_id',
        'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'address' => 'string',
        'zipcode' => 'string',
        'city' => 'string',
        'geolocationX' => 'string',
        'geolocationY' => 'string',
        'status' => 'string',
        'title' => 'string',
        'companyId' => 'integer',
        'projectWebsite'=>'string',
        'visibilityOption'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'address' => 'required',
        'zipcode' => 'required',
        'city' => 'required',
        'geolocationX' => 'required',
        'geolocationY' => 'required',
        'status' => 'required',
        'title' => 'required',
        'yearOfCompletion'=>'required',
        'languageId'=>'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'companyId');
    }
    public function language()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Language::class, 'languageId');
    }

    public function typeOfBuilding()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\TypeOfBuilding::class, 'typeOfBuildingId');
    }
    public function typeOfContruction()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\TypeOfConstruction::class, 'typeOfContructionId');
    }

  
    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class, 'projectId');
    }

    public function projectProperties()
    {
        return $this->hasMany(ProjectProperty::class, 'projectId');
    }

    public function projectVideos()
    {
        return $this->hasMany(ProjectVideo::class, 'projectId');
    }

    public function children()
    {
        return $this->belongsToMany(Project::class, 'parentId');
    }
    
    public static function  getYearOfCompletion($companyId=null,$isArray=false)
    {
 
        if($isArray){
            return Project::whereIn('companyId', $companyId)->groupBy('yearOfCompletion')->pluck('yearOfCompletion');
        }else{
            return Project::where('companyId',$companyId)->groupBy('yearOfCompletion')->pluck('yearOfCompletion');
        }
       
    }

    public static function canton($companyId=null,$isArray=false)
    {
 
        if($isArray){
            return Project::whereIn('companyId', $companyId)->where('canton','!=',NULL)->groupBy('canton')->pluck('canton');
        }else{
            return Project::where('companyId',$companyId)->where('canton','!=',NULL)->groupBy('canton')->pluck('canton');
        }

     }
     //migrateProjects

     public static function getCountryName($project){

        $countryShortName=isset($project['country'])?$project['country']:0;
        $country = Country::where('short_name', $countryShortName )->first();
        $countryName ='Switzerland';

        if($country && $project['language'] =='de'){
            $countryName=$country->de;
        }

        if($country && $project['language'] =='en'){
            $countryName=$country->en;
        }
        return  $countryName; 
     }

     public static function getCantonName($project){

        $cantonShortName=isset($project['canton'])?$project['canton']:0;
        $canton = Canton::where('short_name', $cantonShortName)->first();
        $cantonName ='';

        if($canton && $project['language'] =='de'){
            $cantonName=$canton->de;
        }

        if($canton && $project['language'] =='en'){
            $cantonName=$canton->en;
        }

        if($canton && $project['language'] =='fr'){
            $cantonName=$canton->fr;
        }

        if($canton && $project['language'] =='it'){
            $cantonName=$canton->it;
        }
        return  $cantonName; 
     }
     public static function  migrateProject($company,$project, $lang="en"){
         
        $language = Language::where('shortName', $project['language'])->first();
        if($language){
            $language=\Referenzverwaltung\Models\Language::where('shortName',$lang)->first();
        }

        $countryName ='CH';
        if(isset($project['country'])){
            $countryName = $project['country'];
        }
        $cantonName ='';
        if(isset($project['canton'])){
            $cantonName =$project['canton'];
        }
      
        return Project::updateOrCreate(
            [
                'refo_project_id' => $project['refo_project_id'],
                'companyId' => $company ? $company->id : 0,
            ],
            [
                'refo_project_id' => $project['refo_project_id'],
                'address' => $project['address'],
                'zipcode' => $project['zipcode'],
                'city' => $project['city'],
                'geolocationX' => $project['geolocationX'],
                'geolocationY' => $project['geolocationY'],
                'status' => 1,
                'title' => $project['title'],
                'companyId' => $company ? $company->id : 0,
                'yearOfCompletion' => $project['yearOfCompletion'],
                'description' => $project['description'],
                'projectWebsite' => $project['projectWebsite'],
                'visibilityOption' => 0,
                'country' =>  $countryName,
                'canton'=>$cantonName,
                'languageId' => $language ? $language->id : 0
            ]
        );
     }

    static function downloadProjectByUrl($url){
    
       return json_decode(file_get_contents($url),true);
    }

    public static function filterUniqueProjectAttributeIds($attributeValues=[])
    {
        $projectIds=[];
        foreach($attributeValues as $attributeValue){
            $projectIds[]= ProjectProperty::where('value', $attributeValue)->pluck('projectId');
        }
        
        return $projectIds;
    }
}
