<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SystemAdmin
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 2:48 pm UTC
 *
 * @property \Referenzverwaltung\Models\User $user
 * @property integer $userId
 * @property string $firstName
 * @property string $lastName
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $avatar
 */
class SystemAdmin extends Model
{

    public $table = 'system_admins';
    
    use SoftDeletes;


    public $fillable = [
        'userId',
        'firstName',
        'lastName',
        'phone',
        'mobile',
        'email',
        'avatar',
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
        'userId' => 'integer',
        'firstName' => 'string',
        'lastName' => 'string',
        'phone' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'avatar' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required',
        'mobile' => 'required',
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'avatar' =>'required|image'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(\Referenzverwaltung\Models\User::class, 'userId');
    }
}
