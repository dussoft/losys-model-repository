<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class CategoryLanguage
 * @package App\Models
 * @version November 23, 2021, 5:09 pm UTC
 *
 * @property integer $categoryId
 * @property string $title
 */
class CategoryLanguage extends Model
{


    public $table = 'category_languages';
    use SoftDeletes;



    public $fillable = [
        'categoryId',
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
        'categoryId' => 'integer',
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
    public static function translate($categoryId, $lang="en")
    {
       
        $categoryLang = DB::table('category_languages')
            ->join('categories', 'categories.id', '=', 'category_languages.categoryId')
            ->join('languages', 'languages.id', '=', 'category_languages.languageId')
            ->where('category_languages.categoryId', '=', $categoryId)
            ->where('languages.shortName', $lang)
            ->orderBy('languages.isDefault', 'DESC')
            ->first();

        if(!$categoryLang){
            $categoryLang =  DB::table('category_languages')
                ->join('categories', 'categories.id', '=', 'category_languages.categoryId')
                ->join('languages', 'languages.id', '=', 'category_languages.languageId')
                ->where('category_languages.categoryId', '=', $categoryId)
                ->orderBy('languages.isDefault', 'DESC')
                ->first();
        }

        return $categoryLang;
    }
    
}
