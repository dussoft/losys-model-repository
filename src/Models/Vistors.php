<?php

namespace Referenzverwaltung\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vistors
 * @package Referenzverwaltung\Models
 * @version June 12, 2020, 10:20 pm UTC
 *
 * @property string $ip_address
 * @property string $browser
 * @property string $device
 * @property string $current_location
 * @property string $language
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $root
 * @property string $https
 * @property string $activity
 * @property string $platform
 * @property string $browser_version
 * @property string $device_version
 * @property string $lat
 * @property string $lon
 */
class Vistors extends Model
{

    public $table = 'vistors';
    



    public $fillable = [
        'ip_address',
        'browser',
        'device',
        'current_location',
        'language',
        'country',
        'city',
        'state',
        'root',
        'https',
        'activity',
        'platform',
        'browser_version',
        'device_version',
        'lat',
        'lon'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ip_address' => 'string',
        'browser' => 'string',
        'device' => 'string',
        'current_location' => 'string',
        'language' => 'string',
        'country' => 'string',
        'city' => 'string',
        'state' => 'string',
        'root' => 'string',
        'https' => 'string',
        'activity' => 'string',
        'platform' => 'string',
        'browser_version' => 'string',
        'device_version' => 'string',
        'lat' => 'string',
        'lon' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    function saveVistor($browser, $browser_version, $ip, $dvs, $device_version, $platform,  $location, $country, $city, $state, $root, $language, $https, $lat, $lon, $activity)
    {
       $data=[
        'ip_address' => $ip,
        'browser' => $browser,
        'device' => $dvs,
        'platform' => $platform,
        'browser_version' => $browser_version,
        'device_version' => $device_version,
        'current_location' => $location,
        'country' => $country,
        'city' => $city,
        'state' => $state,
        'root' => $root,
        'language'=>$language,
        'https' =>$https,
        'lat'=>$lat,
        'lon'=>$lon,
        'activity' => $activity
       ];
       return Vistors::create($data);
    }
    
}
