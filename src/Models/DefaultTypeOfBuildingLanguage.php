<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class DefaultTypeOfBuildingLanguage
 * @package Referenzverwaltung\Models
 * @version February 17, 2021, 8:55 am UTC
 *
 * @property integer $typeOfBuildingId
 * @property integer $languageId
 * @property string $title
 */
class DefaultTypeOfBuildingLanguage extends Model
{


    public $table = 'default_type_of_building_languages';
    

    use SoftDeletes;


    public $fillable = [
        'typeOfBuildingId',
        'languageId',
        'title',
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
        'typeOfBuildingId' => 'integer',
        'languageId' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    
}
