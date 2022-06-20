<?php

namespace Referenzverwaltung\Models;
use GeoIP;
use Jenssegers\Agent\Agent;
use Eloquent as Model;

/**
 * Class Vistors
 * @package App\Models
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
    function saveVistor($activity='Vistor')
    {
       // Chrome, IE, Safari, Firefox, ...
       $agent = new Agent();
       $browser = $agent->browser();
       // Ubuntu, Windows, OS X, ...
        $platform = $agent->platform();
        $dvs = $agent->device();
       
        $location = GeoIP::getLocation(request()->ip());

       $data=[
        'ip_address' => request()->ip(),
        'browser' => $agent->browser(),
        'device' => $dvs,
        'platform' => $agent->platform(),
        'browser_version' => $agent->version($browser),
        'device_version' => $agent->version($platform),
        'current_location' => json_encode(GeoIP::getLocation(request()->ip())->toArray()),
        'country' => $location['country'],
        'city' => $location['city'],
        'state' => $location['state_name'],
        'root' => $agent->robot(),
        'language'=>'EN',
        'https' =>request()->server('HTTP_USER_AGENT'),
        'lat'=>$location['lat'],
        'lon'=>$location['lon'],
        'activity' => $activity
       ];

       return Vistors::create($data);
    }
    
}
