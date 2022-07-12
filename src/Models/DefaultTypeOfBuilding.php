<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class DefaultTypeOfBuilding
 * @package Referenzverwaltung\Models
 * @version February 17, 2021, 8:53 am UTC
 *
 */
class DefaultTypeOfBuilding extends Model
{


    public $table = 'default_type_of_buildings';
    

    use SoftDeletes;


    public $fillable = [ 'created_by',
    'deleted_by'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    public function typeofbuildingid()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\TypeOfBuilding::class, 'typeOfBuildingId', 'typeOfBuildingId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function languageid()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Language::class, 'languageId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function typeOfBuildingLanguages()
    {
        return $this->hasMany(\Referenzverwaltung\Models\DefaultTypeOfBuildingLanguage::class, 'typeOfBuilding');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function typeOfBuildingLanguage1s()
    {
        return $this->hasMany(\Referenzverwaltung\Models\DefaultTypeOfBuildingLanguage::class, 'Language');
    }

    public static function translate($typeOfBuildingId, $lang="en")
    {
       
        $typeOfBuildingLang = DB::table('default_type_of_building_languages')
        ->join('default_type_of_buildings', 'default_type_of_buildings.id', '=', 'default_type_of_building_languages.typeOfBuildingId')
        ->join('languages', 'languages.id', '=', 'default_type_of_building_languages.languageId')
        ->where('default_type_of_building_languages.typeOfBuildingId', '=', $typeOfBuildingId)
        ->where('languages.shortName', $lang)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();

        if(!$typeOfBuildingLang){
         
        $typeOfBuildingLang =  DB::table('default_type_of_building_languages')
        ->join('default_type_of_buildings', 'default_type_of_buildings.id', '=', 'default_type_of_building_languages.typeOfBuildingId')
        ->join('languages', 'languages.id', '=', 'default_type_of_building_languages.languageId')
        ->where('default_type_of_building_languages.typeOfBuildingId', '=', $typeOfBuildingId)
        ->where('languages.isDefault', 1)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        }

        return $typeOfBuildingLang;
    }
    
}
