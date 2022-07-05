<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectProperty
 * @package App\Models
 * @version December 21, 2020, 8:13 am UTC
 *
 * @property integer $projectId
 * @property integer $typeOfBuildingId
 * @property integer $yearOfCompletion
 * @property string $projectWebsite
 * @property string $description
 * @property boolean $visibilityOption
 */
class ProjectProperty extends Model
{

    public $table = 'project_properties';
    use SoftDeletes;



    public $fillable = [
        'projectId',
        'projectAttributeId',
        'value',
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
        'projectId' => 'integer',
        'projectAttributeId' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function projectAttribute()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\ProjectAttribute::class, 'projectAttributeId');
    }


    public static function data($companyId=null,$isIframe=false)
    {
        $projectIds = Project::where('companyId', $companyId)->pluck('id');
        if (count($projectIds)  > 0) {
            $propertyIds = ProjectProperty::whereIn('projectId', $projectIds)->pluck('projectAttributeId');

            if (count($propertyIds) > 0) {
                if($isIframe){
                    
                    return ProjectAttribute::whereIn('id', $propertyIds)->where('view_web',1)->orderBy('type', 'ASC')->get();
                    
                }else{
                    return ProjectAttribute::whereIn('id', $propertyIds)->orderBy('type', 'ASC')->get();
                }
                
            }
        }
        return [];
    }

    public static function dataFilter($companyId=null, $isArray=false, $isIframe=false)
    {
        if($isArray){
            $projectIds = Project::whereIn('companyId', $companyId)->pluck('id');
        }
        else{
            $projectIds = Project::where('companyId', $companyId)->pluck('id');
        }
        if (count($projectIds)  > 0) {
            $propertyIds = ProjectProperty::whereIn('projectId', $projectIds)->pluck('projectAttributeId');
            $attributes=[];

            if (count($propertyIds) > 0) {
                if($isIframe){
                    $attributes= ProjectAttribute::whereIn('id', $propertyIds)->where('view_web',1)->orderBy('type', 'ASC')->get();
                }else{
                    $attributes= ProjectAttribute::whereIn('id', $propertyIds)->orderBy('type', 'ASC')->get();
                }
                $resultattributesToDisplay=[];
                foreach($attributes as $attribute){
                    $atttributeTranslated=\Referenzverwaltung\Models\ProjectAttributeLanguage::translate($attribute->id);
                    if($atttributeTranslated && $atttributeTranslated->label && ($attribute->type=='number' || $attribute->type=='employees' || $attribute->type=='bool')){
                        $attributeToDisplay = new DisplayAttribute;
                        $attributeToDisplay->label=$atttributeTranslated->label;
                        $attributeToDisplay->id=$attribute->id;
                        $attributeToDisplay->type=$attribute->type;
                        $resultattributesToDisplay[]=$attributeToDisplay;
                    }
                }

                $labelUsedAssociatedWithType=[];
                $arrangedAttributes=[];
                foreach($resultattributesToDisplay as $resultattributeToDisplay){
                    if(in_array($resultattributeToDisplay->label.$resultattributeToDisplay->type, $labelUsedAssociatedWithType)){
                        $key = array_search($resultattributeToDisplay->label.$resultattributeToDisplay->type, $labelUsedAssociatedWithType);
                        $arrangedAttributes[$key]->id=$arrangedAttributes[$key]->id.'_'.$resultattributeToDisplay->id;
                    }
                    else{
                        $labelUsedAssociatedWithType[]=$resultattributeToDisplay->label.$resultattributeToDisplay->type;
                        $arrangedAttributes[]=$resultattributeToDisplay;
                    }
                }

                return $arrangedAttributes;
            }
        }
        return [];
    }
    
}

class DisplayAttribute{
    public $id;
    public $label;
    public $type;
}