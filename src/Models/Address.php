<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Address
 * @package App\Models
 * @version December 19, 2020, 4:50 pm UTC
 *
 * @property \App\Models\Company $company
 * @property string $status
 * @property string $name
 * @property string $alternativeName
 * @property string $mailBox
 * @property string $address
 * @property string $zipcode
 * @property string $city
 * @property string $country
 * @property integer $companyId
 */
class Address extends Model
{

    public $table = 'addresses';
    
    use SoftDeletes;



    public $fillable = [
        'status',
        'name',
        'alternativeName',
        'mailBox',
        'address',
        'zipcode',
        'city',
        'phone',
        'fax',
        'email',
        'website',
        'geolocationX',
        'geolocationY',
        'logoUrl',
        'country',
        'companyId',
        'view_web',
        'view_datenblatt_extern',
        'view_datenblatt_intern',
        'refo_address_id',
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
        'status' => 'string',
        'name' => 'string',
        'alternativeName' => 'string',
        'mailBox' => 'string',
        'address' => 'string',
        'zipcode' => 'string',
        'city' => 'string',
        'country' => 'string',
        'phone' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'website' => 'string',
        'geolocationX' => 'string',
        'geolocationY' => 'string',
        'logoUrl' => 'string',
        'companyId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'city' => 'required',
        'country' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'company');
    }

    public function contactPerson(){
        return $this->hasMany(\Referenzverwaltung\Models\AddressCompanyContactPerson::class, 'addressId');
    }
}
