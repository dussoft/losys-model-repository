<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TypeOfWork
 * @package App\Models
 * @version December 19, 2020, 3:49 pm UTC
 *
 * @property \App\Models\Company $companyid
 * @property integer $companyId
 */
class TypeOfWork extends Model
{

    public $table = 'type_of_works';
    
    use SoftDeletes;


    public $fillable = [
        'companyId',
        'refo_type_of_work_id',
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
        'title' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'companyId', 'companyId');
    }
    
}
