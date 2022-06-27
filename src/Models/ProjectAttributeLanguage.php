<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ProjectAttributeLanguage
 * @package App\Models
 * @version December 21, 2020, 8:28 am UTC
 *
 * @property integer $projectAttributeId
 * @property string $field
 * @property string $value
 */
class ProjectAttributeLanguage extends Model
{

    public $table = 'project_attribute_languages';
    
    use SoftDeletes;


    public $fillable = [
        'projectAttributeId',
        'languageId',
        'label',
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
        'projectAttributeId' => 'integer',
        'languageId' => 'integer',
        'label' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public static function translate($projectAttributeId, $lang="en")
    {
       
        $projectAttributeLang = DB::table('project_attribute_languages')
        ->join('project_attributes', 'project_attributes.id', '=', 'project_attribute_languages.projectAttributeId')
        ->join('languages', 'languages.id', '=', 'project_attribute_languages.languageId')
        ->where('project_attribute_languages.projectAttributeId', '=', $projectAttributeId)
        ->where('languages.shortName', $lang)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();

        if(!$projectAttributeLang){
         
        $projectAttributeLang =  DB::table('project_attribute_languages')
        ->join('project_attributes', 'project_attributes.id', '=', 'project_attribute_languages.projectAttributeId')
        ->join('languages', 'languages.id', '=', 'project_attribute_languages.languageId')
        ->where('project_attribute_languages.projectAttributeId', '=', $projectAttributeId)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        }

        return $projectAttributeLang;
    }

    
}
