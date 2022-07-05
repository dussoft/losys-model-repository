<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProjectTypeOfBuilding
 * @package App\Models
 * @version February 18, 2021, 8:19 am UTC
 *
 * @property integer $typeOfBuildingId
 * @property integer $projectId
 */
class ProjectTypeOfBuilding extends Model
{


    public $table = 'project_type_of_buildings';
    use SoftDeletes;



    public $fillable = [
        'typeOfBuildingId',
        'projectId',
        'refo_type_of_building_id',
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
        'typeOfBuildingId' => 'integer',
        'projectId' => 'integer'
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
            $projectIds = Project::where('companyId', $companyId)->pluck('id');
        }
        if (count($projectIds)  > 0) {
            $typeOfBuildingids = ProjectTypeOfBuilding::whereIn('projectId', $projectIds)->pluck('typeOfBuildingId');


            if (count($typeOfBuildingids) > 0) {

                return TypeOfBuilding::whereIn('id', $typeOfBuildingids)->get();
            }
        }
        return [];
    }
    public static function migrateProjectTypeOfBuilding($data)
    {
        if ($data['refo_type_of_building_id']) {
            $typeOfBuilding = TypeOfBuilding::where('companyId', $data['companyId'])->where('refo_type_of_building_id', $data['refo_type_of_building_id'])->first();
            if ($typeOfBuilding) {

                $data1=[
                    'typeOfBuildingId'=> $typeOfBuilding->id,
                    'refo_type_of_building_id'=>intval($data['refo_type_of_building_id']),
                    'projectId'=>$data['projectId']
            ];
                return ProjectTypeOfBuilding::updateOrCreate($data1, $data1);
            }
        }
    }
}
