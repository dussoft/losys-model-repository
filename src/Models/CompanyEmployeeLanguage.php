<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class CompanyEmployee
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 4:28 pm UTC
 *
 * @property \Referenzverwaltung\Models\User $user
 * @property \Referenzverwaltung\Models\Company $company
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
class CompanyEmployeeLanguage extends Model
{

    public $table = 'employee_langauages';
    
    use SoftDeletes;


    public $fillable = [
        'id',
        'languageId',
        'employeId',
        'function',
        'education',
        'skills',
        'created_by',
        'deleted_by'
    ];

    public static function translate($employeId, $lang="en")
    {
        $categoryLang = DB::table('employee_langauages')
        //  ->join('users', 'users.id', '=', 'employee_langauages.employeId')
        ->join('languages', 'languages.id', '=', 'employee_langauages.languageId')
         ->where('employee_langauages.employeId', '=', $employeId)
        ->where('languages.shortName', $lang)
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
