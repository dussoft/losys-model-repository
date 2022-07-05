<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProjectCategory
 * @package App\Models
 * @version December 1, 2021, 1:23 pm UTC
 *
 * @property integer $projectId
 * @property integer $categoryId
 * @property integer $refo_category_id
 */
class ProjectCategory extends Model
{


    public $table = 'project_categories';
    use SoftDeletes;



    public $fillable = [
        'projectId',
        'categoryId',
        'refo_category_id',
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
        'categoryId' => 'integer',
        'refo_category_id' => 'integer'
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
            
            $categoryIds = ProjectCategory::whereIn('projectId', $projectIds)->pluck('categoryId');

            if (count($categoryIds) > 0) {

                return Category::whereIn('id', $categoryIds)->get();
            }
        }
        return [];
    }

    public static function migrateProjectCategory($data)
    {

        if (isset($data['refo_category_ids'])) {
            $refo_category_ids = explode(',', $data['refo_category_ids']);
        
           
            if (count($refo_category_ids) > 0) {

                foreach ($refo_category_ids as $refo_category_id) {

                    $category = Category::where('companyId', $data['companyId'])->where('refo_category_id', $refo_category_id)->first();

                    if ($category) {
                       
                        $data1=[
                                'categoryId'=> $category->id,
                                'refo_category_id'=>$refo_category_id,
                                'projectId'=>$data['projectId']
                        ];
                       
                        ProjectCategory::updateOrCreate($data1, $data1);
                    }
                }
            }
        }
    }

    
}
