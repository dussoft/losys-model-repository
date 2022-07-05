<?php

namespace App\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 * @package App\Models
 * @version December 19, 2020, 3:05 pm UTC
 *
 * @property string $name
 */
class Service extends Model
{

    public $table = 'services';
    
    use SoftDeletes;


    public $fillable = [
        'name','index',
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
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'index' => 'required',
    ];

    
}
