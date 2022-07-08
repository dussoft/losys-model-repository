<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class TypeOfWorkLanguage
 * @package App\Models
 * @version December 19, 2020, 3:55 pm UTC
 *
 * @property \App\Models\Language $languageid
 * @property \App\Models\typeOfWorkId $typeofworkid
 * @property integer $typeOfWorkId
 * @property integer $languageId
 * @property string $title
 */
class TypeOfWorkLanguage extends Model
{

    public $table = 'type_of_work_langauages';
    
    use SoftDeletes;


    public $fillable = [
        'typeOfWorkId',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function languageid()
    {
        return $this->belongsTo(\App\Models\Language::class, 'languageId', 'languageId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeofwork()
    {
        return $this->belongsTo(\App\Models\TypeOfWork::class, 'typeOfWorkId', 'typeOfWorkId');
    }

    public static function translate($typeOfWorkId, $lang=en)
    {
       
        $typeOfWorkLang = DB::table('type_of_work_langauages')
            ->join('type_of_works', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
            ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
            ->where('type_of_work_langauages.typeOfWorkId', '=', $typeOfWorkId)
            ->where('languages.shortName', $lang)
            ->orderBy('type_of_work_langauages.title','DESC')
            ->orderBy('languages.isDefault', 'DESC')
            ->first();

        if(!$typeOfWorkLang){

            $typeOfWorkLang = DB::table('type_of_work_langauages')
                ->join('type_of_works', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
                ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
                ->where('type_of_work_langauages.typeOfWorkId', '=', $typeOfWorkId)
                ->orderBy('type_of_work_langauages.title','DESC')
                ->orderBy('languages.isDefault', 'DESC')
                
                ->first();
                
        }

        return $typeOfWorkLang ;
    }

    public static function search($text, $lang="en", $companyId=0)
    {
        $typeOfWorkLang = DB::table('type_of_work_langauages')
            ->join('type_of_works', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
            ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
            ->where('type_of_works.companyId', '=', $companyId)
            ->where('type_of_work_langauages.title', 'Like',  "%". $this->escape_like($text) ."%")
            ->where('languages.shortName', $lang)
            ->orderBy('type_of_work_langauages.title','DESC')
            ->get();
        if(!$typeOfWorkLang){
            $typeOfWorkLang = DB::table('type_of_work_langauages')
            ->join('type_of_works', 'type_of_works.id', '=', 'type_of_work_langauages.typeOfWorkId')
            ->join('languages', 'languages.id', '=', 'type_of_work_langauages.languageId')
            ->where('type_of_works.companyId', '=', $companyId)
            ->where('type_of_work_langauages.title', 'Like', "%". $this->escape_like($text) ."%")
            ->orderBy('type_of_work_langauages.title','DESC')
            ->get();     
        }
        return $typeOfWorkLang ;
    }

    public function escape_like(string $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $value
        );
    }
    
}
