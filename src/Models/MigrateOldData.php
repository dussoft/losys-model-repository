<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;


/**
 * Class MigrateOldData
 * @package App\Models
 * @version April 27, 2021, 7:50 am UTC
 *
 * @property string $file_name
 */
class MigrateOldData extends Model
{


    public $table = 'migrate_old_datas';
    


    public $fillable = [
        'file_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'file_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'file_name' => 'required'
    ];

    
}
