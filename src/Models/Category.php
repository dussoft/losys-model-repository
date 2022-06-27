<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Category
 * @package App\Models
 * @version November 23, 2021, 5:08 pm UTC
 *
 * @property integer $companyId
 * @property integer $refo_type_of_work_id
 */
class Category extends Model
{

    use SoftDeletes;
    
    public $table = 'categories';
    



    public $fillable = [
        'companyId',
        'refo_category_id', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'companyId' => 'integer',
        'refo_category_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
   

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function company()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Company::class, 'companyId', 'companyId');
    }
    
}
