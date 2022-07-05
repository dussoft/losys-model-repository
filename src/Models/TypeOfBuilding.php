<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class TypeOfBuilding
 * @package App\Models
 * @version December 19, 2020, 3:59 pm UTC
 *
 * @property \App\Models\Company $companyid
 * @property integer $companyId
 */
class TypeOfBuilding extends Model
{

    public $table = 'type_of_buildings';
    use SoftDeletes;



    public $fillable = [
        'companyId',
        'refo_type_of_building_id',
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
    public function companyid()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'companyId', 'companyId');
    }
}
