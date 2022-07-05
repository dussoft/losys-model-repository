<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class DefaultTypeOfConstructionLanguage
 * @package App\Models
 * @version February 17, 2021, 10:41 am UTC
 *
 * @property integer $typeOfConstrationId
 * @property integer $languageId
 * @property string $title
 */
class DefaultTypeOfConstructionLanguage extends Model
{


    public $table = 'default_type_of_construction_lang';
    use SoftDeletes;



    public $fillable = [
        'typeOfConstrationId',
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
        'typeOfConstrationId' => 'integer',
        'languageId' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function language()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Language::class, 'language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeofconstration()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\DefaultTypeOfConstruction::class, 'typeOfConstration');
    }

    public static function translate($typeOfConstructionId, $lang="en")
    {
       
        $typeOfConstructionLang = DB::table('default_type_of_construction_lang')
        ->join('default_type_of_constructions', 'default_type_of_constructions.id', '=', 'default_type_of_construction_lang.typeOfConstrationId')
        ->join('languages', 'languages.id', '=', 'default_type_of_construction_lang.languageId')
        ->where('default_type_of_construction_lang.typeOfConstrationId', '=', $typeOfConstructionId)
        ->where('languages.shortName', $lang)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();

        if(!$typeOfConstructionLang){
         
        $typeOfConstructionLang = DB::table('default_type_of_construction_lang')
        ->join('default_type_of_constructions', 'default_type_of_constructions.id', '=', 'default_type_of_construction_lang.typeOfConstrationId')
        ->join('languages', 'languages.id', '=', 'default_type_of_construction_lang.languageId')
        ->where('default_type_of_construction_lang.typeOfConstrationId', '=', $typeOfConstructionId)

        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        }

        return $typeOfConstructionLang;
    }
}
