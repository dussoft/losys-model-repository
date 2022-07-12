<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Language
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 2:14 pm UTC
 *
 * @property string $name
 * @property string $shortName
 * @property boolean $isDefault
 */
class Language extends Model
{

    public $table = 'languages';
    use SoftDeletes;



    public $fillable = [
        'name',
        'shortName',
        'isDefault', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'shortName' => 'string',
        'isDefault' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'shortName' => 'required',
        'languagePack' => 'required',
        'isDefault' => 'required'
    ];


    public static function byCompany($companyId=null)
    {
        $languages = CompanyLanguage::where('companyId', $companyId)->get();
        $allLanguages=[];
        if(count($languages) > 0){
            foreach($languages as $language){
                $allLanguages[]=$language->language;
            }

        }
        return $allLanguages;
    }

    public static function byCompanyNotIn($langId,$companyId=null)
    {
        $languages = CompanyLanguage::where('companyId', $companyId)->whereNotIn('languageId',$langId)->get();
        $allLanguages=[];
        if(count($languages) > 0){

            foreach($languages as $language){
                $allLanguages[]=$language->language;
            }

        }
        return $allLanguages;
    }
}
