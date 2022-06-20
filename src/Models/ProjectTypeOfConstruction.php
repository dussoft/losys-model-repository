<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProjectTypeOfContruction
 * @package App\Models
 * @version February 18, 2021, 8:17 am UTC
 *
 * @property integer $projectId
 * @property integer $typeOfContructionId
 */
class ProjectTypeOfConstruction extends Model
{


    public $table = 'project_type_of_contructions';
    use SoftDeletes;



    public $fillable = [
        'projectId',
        'typeOfContructionId',
        'refo_type_of_construction_id',
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
        'typeOfContructionId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public static function data($companyId=null,$isArray=false)
    {
 
        if($isArray){
            $projectIds = Project::whereIn('companyId', $companyId)->pluck('id');
        }else{
            $projectIds = Project::where('companyId', $companyId?$companyId:\App\Models\Company::getActiveCompanyId())->pluck('id');
        }
        
    if (count($projectIds)  > 0) {
            $typeOfConstructionIds = ProjectTypeOfContruction::whereIn('projectId', $projectIds)->pluck('typeOfContructionId');

            if (count($typeOfConstructionIds) > 0) {

                return TypeOfConstruction::whereIn('id', $typeOfConstructionIds)->get();
            }
        }
        return [];
    }

    public static function migrateProjectTypeOfContruction($data)
    {
        if ($data['refo_type_of_construction_id']) {
            $typeOfContruction = TypeOfConstruction::where('companyId', $data['companyId'])->where('refo_type_of_construction_id', $data['refo_type_of_construction_id'])->first();
            if ($typeOfContruction) {
                $data1=[
                    'typeOfContructionId'=> $typeOfContruction->id,
                    'refo_type_of_construction_id'=>intval($data['refo_type_of_construction_id']),
                    'projectId'=>$data['projectId']
            ];
                return ProjectTypeOfContruction::updateOrCreate($data1, $data1);
            }
        }
    }
}
