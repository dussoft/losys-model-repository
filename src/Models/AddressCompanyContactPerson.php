<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class AddressCompanyContactPerson
 * @package App\Models
 * @version January 26, 2021, 5:07 pm UTC
 *
 * @property string $firstName
 * @property string $lastName
 * @property string $function
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $gender
 * @property string $yearOfBirth
 * @property string $education
 * @property string $status
 * @property string $skills
 * @property integer $addressId
 * @property string $avatar
 */
class AddressCompanyContactPerson extends Model
{


    public $table = 'address_company_contact_persons';
    
    use SoftDeletes;


    public $fillable = [
        'firstName',
        'lastName',
        'vibilityOption',
        'phone',
        'mobile',
        'email',
        'addressId',
        'avatar',
        'gender',
        'old_contact_person_id', 
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
        'phone' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'addressId' => 'integer',
        'vibilityOption' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'firstName'=> 'required',
        'lastName'=> 'required',
        'gender'=> 'required',
    ];

    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class, 'addressId');
    }

    public function getYearOfBirthAttribute($value){

        return date("d M Y",strtotime($value));
        
    }
}
