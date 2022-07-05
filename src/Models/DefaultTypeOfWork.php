<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class DefaultTypeOfWork
 * @package App\Models
 * @version February 17, 2021, 7:47 am UTC
 *
 */
class DefaultTypeOfWork extends Model
{


    public $table = 'default_type_of_works';
    
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
