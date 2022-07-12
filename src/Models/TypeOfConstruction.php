<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class TypeOfConstruction
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 4:10 pm UTC
 *
 * @property \Referenzverwaltung\Models\Company $companyid
 * @property integer $companyId
 */
class TypeOfConstruction extends Model
{

    public $table = 'type_of_constructions';
    
    use SoftDeletes;


    public $fillable = [
        'companyId',
        'refo_type_of_construction_id',
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
        'companyId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'companyId');
    }

    
}
