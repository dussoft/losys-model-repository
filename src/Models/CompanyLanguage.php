<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class CompanyEmployee
 * @package App\Models
 * @version December 19, 2020, 4:28 pm UTC
 *
 * @property \App\Models\User $user
 * @property \App\Models\Company $company
 * @property integer $status
 * @property integer $firstName
 * @property integer $lastName
 * @property integer $phone
 * @property integer $mobile
 * @property integer $email
 * @property integer $language
 * @property integer $userId
 * @property integer $companyId
 */
class CompanyLanguage extends Model
{

    public $table = 'company_langauages';
    use SoftDeletes;



    public $fillable = [
        'languageId',
        'companyId',
        'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
 

    /**
     * Validation rules
     *
     * @var array
     */

    public function language()
    {
        return $this->belongsTo(\App\Models\Language::class, 'languageId');
    }


    public static function translate($employeId)
    {
       
        
        $categoryLang = DB::table('employee_langauages')
        //  ->join('users', 'users.id', '=', 'employee_langauages.employeId')
        ->join('languages', 'languages.id', '=', 'employee_langauages.languageId')
         ->where('employee_langauages.employeId', '=', $employeId)
        ->where('languages.shortName', app()->getLocale())
        ->orderBy('languages.isDefault', 'DESC')
        ->first();

        if(!$categoryLang){
         
        $categoryLang =  DB::table('employee_langauages')
        //  ->join('users', 'users.id', '=', 'employee_langauages.employeId')
        ->join('languages', 'languages.id', '=', 'employee_langauages.languageId')
         ->where('employee_langauages.employeId', '=', $employeId)
        ->orderBy('languages.isDefault', 'DESC')
        ->first();
        }

        return $categoryLang;
    }
}
