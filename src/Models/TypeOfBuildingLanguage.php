<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class TypeOfBuildingLanguage
 * @package App\Models
 * @version December 19, 2020, 4:07 pm UTC
 *
 * @property \App\Models\TypeOfBuilding $typeofbuildingid
 * @property \App\Models\Language $languageid
 * @property \Illuminate\Database\Eloquent\Collection $typeOfBuildingLanguages
 * @property \Illuminate\Database\Eloquent\Collection $typeOfBuildingLanguage1s
 * @property integer $typeOfBuildingId
 * @property integer $languageId
 * @property string $title
 */
class TypeOfBuildingLanguage extends Model
{

    public $table = 'type_of_building_languages';
    
    use SoftDeletes;


    public $fillable = [
        'typeOfBuildingId',
        'languageId',
        'title',
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
        'languageId' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
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
        return $this->hasMany(\Referenzverwaltung\Models\TypeOfBuildingLanguage::class, 'typeOfBuilding');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function typeOfBuildingLanguage1s()
    {
        return $this->hasMany(\Referenzverwaltung\Models\TypeOfBuildingLanguage::class, 'Language');
    }

    public static function translate($typeOfBuildingId, $lang="en")
    {
       
        $typeOfBuildingLang = DB::table('type_of_building_languages')
        ->join('type_of_buildings', 'type_of_buildings.id', '=', 'type_of_building_languages.typeOfBuildingId')
        ->join('languages', 'languages.id', '=', 'type_of_building_languages.languageId')
        ->where('type_of_building_languages.typeOfBuildingId', '=', $typeOfBuildingId)
        ->where('languages.shortName', $lang)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();

        if(!$typeOfBuildingLang){
         
        $typeOfBuildingLang =  DB::table('type_of_building_languages')
        ->join('type_of_buildings', 'type_of_buildings.id', '=', 'type_of_building_languages.typeOfBuildingId')
        ->join('languages', 'languages.id', '=', 'type_of_building_languages.languageId')
        ->where('type_of_building_languages.typeOfBuildingId', '=', $typeOfBuildingId)
      
        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        }

        return $typeOfBuildingLang;
    }
}
