<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Country
 * @package App\Models
 * @version June 3, 2021, 12:36 pm UTC
 *
 * @property string $short_name
 * @property string $de
 * @property string $en
 */
class Country extends Model
{


    public $table = 'countries';

    use SoftDeletes;


    public $fillable = [
        'short_name',
        'de',
        'en', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'short_name' => 'string',
        'de' => 'string',
        'en' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'short_name' => 'required'
    ];

    public static function getCountryName($country)
    {

        $countryName = 'Switzerland';


        if ($country && app()->getLocale() == 'de') {
            $countryName = $country->de;
        } else if ($country && app()->getLocale() == 'en') {
            $countryName = $country->en;
        } else {
            $lang = \App\Models\Language::where('isDefault', 1)->first();
            if ($country && $lang && $lang->shortName == 'de') {
                $countryName = $country->de;
            } else if ($country && $lang && $lang->shortName == 'en') {
                $countryName = $country->en;
            }
        }
        return  $countryName;
    }
}
