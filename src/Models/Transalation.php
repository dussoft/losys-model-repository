<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transalation
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 2:33 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $languages
 * @property string $key
 * @property string $value
 * @property integer $languageId
 */
class Transalation extends Model
{

    public $table = 'transalations';
    


    public $fillable = [
        'key',
        'value',
        'languageId'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'key' => 'string',
        'languageId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'key' => 'required',
        'value' => 'required',
        'languageId' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function languages()
    {
        return $this->hasMany(\Referenzverwaltung\Models\Language::class, 'languageId', 'languageId');
    }
}
