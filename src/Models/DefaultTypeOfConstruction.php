<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class DefaultTypeOfConstruction
 * @package App\Models
 * @version February 17, 2021, 10:34 am UTC
 *
 */
class DefaultTypeOfConstruction extends Model
{


    public $table = 'default_type_of_constructions';
    use SoftDeletes;



    public $fillable = [
        'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
