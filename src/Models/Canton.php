<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Canton
 * @package Referenzverwaltung\Models
 * @version June 3, 2021, 11:21 am UTC
 *
 * @property string $short_name
 * @property string $de
 * @property string $fr
 * @property string $it
 * @property string $en
 */
class Canton extends Model
{

    use SoftDeletes;

    public $table = 'cantons';
    



    public $fillable = [
        'short_name',
        'de',
        'fr',
        'it',
        'en',
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
        'short_name' => 'string',
        'de' => 'string',
        'fr' => 'string',
        'it' => 'string',
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

    
}
