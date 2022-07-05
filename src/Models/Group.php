<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Group
 * @package App\Models
 * @version December 19, 2020, 3:04 pm UTC
 *
 * @property string $name
 */
class Group extends Model
{

    public $table = 'groups';
    
    use SoftDeletes;


    public $fillable = [
        'name', 
        'created_by',
        'css_file',
        'js_file',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'css_file'=>'string',
        'js_file'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
