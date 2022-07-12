<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TypeOfConstructionLanguage
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 4:23 pm UTC
 *
 * @property \Referenzverwaltung\Models\Language $language
 * @property \Referenzverwaltung\Models\TypeOfConstruction $typeofconstration
 * @property string $title
 * @property integer $typeOfConstrationId
 * @property integer $languageId
 */
class TypeOfConstructionLanguage extends Model
{

    public $table = 'type_of_construction_languages';
    use SoftDeletes;



    public $fillable = [
        'title',
        'typeOfConstrationId',
        'languageId',
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
        'title' => 'string',
        'typeOfConstrationId' => 'integer',
        'languageId' => 'integer'
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
    public function language()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Language::class, 'language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeofconstration()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\TypeOfConstruction::class, 'typeOfConstration');
    }

    public static function translate($typeOfConstructionId, $lang="en")
    {
       
        $typeOfConstructionLang = DB::table('type_of_construction_languages')
        ->join('type_of_constructions', 'type_of_constructions.id', '=', 'type_of_construction_languages.typeOfConstrationId')
        ->join('languages', 'languages.id', '=', 'type_of_construction_languages.languageId')
        ->where('type_of_construction_languages.typeOfConstrationId', '=', $typeOfConstructionId)
        ->where('languages.shortName', $lang)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();

        if(!$typeOfConstructionLang){
         
        $typeOfConstructionLang = DB::table('type_of_construction_languages')
        ->join('type_of_constructions', 'type_of_constructions.id', '=', 'type_of_construction_languages.typeOfConstrationId')
        ->join('languages', 'languages.id', '=', 'type_of_construction_languages.languageId')
        ->where('type_of_construction_languages.typeOfConstrationId', '=', $typeOfConstructionId)

        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        }

        return $typeOfConstructionLang;
    }
}
