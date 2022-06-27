<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class DefaultTypeOfWorkLanguage
 * @package App\Models
 * @version February 17, 2021, 7:49 am UTC
 *
 * @property integer $typeOfWorkId
 * @property integer $languageId
 * @property string $title
 */
class DefaultTypeOfWorkLanguage extends Model
{


    public $table = 'default_type_of_work_langauages';
    
    use SoftDeletes;


    public $fillable = [
        'typeOfWorkId',
        'languageId',
        'title', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'typeOfWorkId' => 'integer',
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
    public function language()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Language::class, 'languageId', 'languageId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    **/

    public function defaultTypeofwork()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\DefaultTypeOfWork::class, 'typeOfWorkId', 'typeOfWorkId');
    }

    public static function translate($typeOfWorkId, $lang="en")
    {
       
        $typeOfWorkLang = DB::table('default_type_of_work_langauages')
        ->join('default_type_of_works', 'default_type_of_works.id', '=', 'default_type_of_work_langauages.typeOfWorkId')
        ->join('languages', 'languages.id', '=', 'default_type_of_work_langauages.languageId')
        ->where('default_type_of_work_langauages.typeOfWorkId', '=', $typeOfWorkId)
        ->where('languages.shortName', $lang)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        
        if(!$typeOfWorkLang){

            $typeOfWorkLang = DB::table('default_type_of_work_langauages')
            ->join('default_type_of_works', 'default_type_of_works.id', '=', 'default_type_of_work_langauages.typeOfWorkId')
            ->join('languages', 'languages.id', '=', 'default_type_of_work_langauages.languageId')
            ->where('default_type_of_work_langauages.typeOfWorkId', '=', $typeOfWorkId)
            ->orderBy('languages.isDefault', 'DESC')
            ->first();

        }

        return $typeOfWorkLang;
    }
    
}
