<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;

/**
 * Class Service
 * @package App\Models
 * @version December 19, 2020, 3:05 pm UTC
 *
 * @property string $name
 */
class Error extends Model
{

    public $table = 'errors';
    



    public $fillable = [
        'error','description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    
}
