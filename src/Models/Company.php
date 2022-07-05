<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Company
 * @package App\Models
 * @version December 19, 2020, 3:32 pm UTC
 *
 * @property \App\Models\Group $groupid
 * @property string $status
 * @property string $name
 * @property string $alternativeName
 * @property string $mailBox
 * @property string $address
 * @property string $zipcode
 * @property string $city
 * @property string $country
 * @property integer $groupId
 */
class Company extends Model
{

    public $table = 'companies';
    
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
        'refo_company_id',
        'language',
        'numberOfUser', 
        'socialMedia',
        'created_by',
        'deleted_by',
        'css_file',
        'auto_import',
        'auto_update',
        'js_file'
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
        'groupId' => 'integer',
        'phone' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'website' => 'string',
        'geolocationX' => 'string',
        'geolocationY' => 'string',
        'logoUrl' => 'string',
        'language'=>'string',
        'numberOfUser'=>'integer',
        'socialMedia'=>'string',
        'css_file'=>'string',
        'js_file'=>'string'
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
    public function groups()
    {
        return $this->belongsToMany(\Referenzverwaltung\Models\GroupCompany::class, 'groupId');
    }

}
