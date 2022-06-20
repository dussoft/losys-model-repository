<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
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
class CompanyEmployee extends Model
{

    use SoftDeletes;
    public $table = 'users';
    



    public $fillable = [
        'firstName',
        'name',
        'lastName',
        'function',
        'phone',
        'mobile',
        'email',
        'gender',
        'yearOfBirth',
        'education',
        'status',
        'password',
        'skills',
        'companyId',
        'refo_employee_id',
        'avatar',
        'rule',
        'created_by',
        'deleted_by',
        'in_company_since'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'string',
        'firstName' => 'string',
        'lastName' => 'string',
        'phone' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'language' => 'string',
        'userId' => 'integer',
        'companyId' => 'integer',
        'gender' => 'string',
        'yearOfBirth' => 'integer',
        'function' => 'string',
        'education' => 'string',
        'skills' => 'string',
        'pictureUrl' => 'string',
        'in_company_since' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'firstName'=> 'required',
        'lastName'=> 'required',
        'email'=> ['required', 'string', 'email', 'max:255', 'unique:users'],
        'gender'=> 'required',
        'status'=> 'required',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company');
    }

   
}
