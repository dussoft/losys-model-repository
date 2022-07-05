<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProjectTypeOfWork
 * @package App\Models
 * @version January 20, 2021, 1:37 pm UTC
 *
 * @property integer $projectId
 * @property integer $typeOfWorkId
 */
class ProjectTypeOfWork extends Model
{


    public $table = 'project_type_of_works';
    use SoftDeletes;



    public $fillable = [
        'projectId',
        'typeOfWorkId',
        'refo_type_of_work_id',
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
        'typeOfWorkId' => 'integer'
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
            $typeOfWorkIds = ProjectTypeOfWork::whereIn('projectId', $projectIds)->pluck('typeOfWorkId');

            if (count($typeOfWorkIds) > 0) {

                return TypeOfWork::whereIn('id', $typeOfWorkIds)->get();
            }
        }
        return [];
    }

    public static function migrateProjectTypeOfWork($data)
    {

        if (isset($data['refo_type_of_work_ids'])) {
            $refo_type_of_work_ids = explode(',', $data['refo_type_of_work_ids']);
        
           
            if (count($refo_type_of_work_ids) > 0) {

                foreach ($refo_type_of_work_ids as $refo_type_of_work_id) {

                    $typeOfWork = TypeOfWork::where('companyId', $data['companyId'])->where('refo_type_of_work_id', $refo_type_of_work_id)->first();

                    if ($typeOfWork) {
                       
                        $data1=[
                                'typeOfWorkId'=> $typeOfWork->id,
                                'refo_type_of_work_id'=>$refo_type_of_work_id,
                                'projectId'=>$data['projectId']
                        ];
                       
                         ProjectTypeOfWork::updateOrCreate($data1, $data1);
                    }
                }
            }
        }
    }
}
