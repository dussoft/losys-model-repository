<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class GroupCompany
 * @package App\Models
 * @version January 6, 2021, 9:22 am UTC
 *
 * @property integer $group_id
 * @property integer $company_id
 * @property boolean $switch
 */
class GroupCompany extends Model
{


    public $table = 'group_companies';
    
    use SoftDeletes;


    public $fillable = [
        'groupId',
        'companyId', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'groupId' => 'integer',
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

    public function companies()
    {
        return $this->belongsToMany(\Referenzverwaltung\Models\Company::class, 'companyId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function group()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Group::class, 'groupId');
    }

    public static function data()
    {
        $companiesIds = Company::pluck('id');

        if(count($companiesIds) > 0){

            $groupIds = GroupCompany::whereIn('companyId',$companiesIds)->pluck('groupId');

            if(count($groupIds) > 0){
                return Group::whereIn('id',$groupIds)->get();
            }

        }
        return [];
    }

}
