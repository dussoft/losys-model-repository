<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class GroupCompany
 * @package Referenzverwaltung\Models
 * @version January 6, 2021, 9:22 am UTC
 *
 * @property integer $group_id
 * @property integer $company_id
 * @property boolean $switch
 */
class GroupRight extends Model
{


    public $table = 'group_rights';
    
    use SoftDeletes;


    public $fillable = [
        'memberId',
        'companyId',
        'enable_print_edit', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'memberId' => 'integer',
        'companyId' => 'integer',
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

    public function member()
    {
        return $this->belongsTo(User::class, 'memberId');
    }

   
}
