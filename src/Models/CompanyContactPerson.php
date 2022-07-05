<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class CompanyContactPerson
 * @package App\Models
 * @version December 19, 2020, 4:57 pm UTC
 *
 * @property \App\Models\Company $company
 * @property string $firstName
 * @property string $lastName
 * @property string $function
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $state
 * @property string $emailOption
 * @property integer $companyId
 */
class CompanyContactPerson extends Model
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
        'skills',
        'companyId',
        'password',
        'refo_employee_id',
        'avatar',
        'rule',
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
        'firstName' => 'string',
        'lastName' => 'string',
        'function' => 'string',
        'phone' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'status' => 'string',
        'education' => 'string',
        'companyId' => 'integer'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'company');
    }

    

}
