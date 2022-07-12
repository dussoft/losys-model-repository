<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class GroupService
 * @package Referenzverwaltung\Models
 * @version December 19, 2020, 3:13 pm UTC
 *
 * @property \Referenzverwaltung\Models\Service $serviceid
 * @property \Referenzverwaltung\Models\Group $groupid
 * @property integer $gqw 
 * 3456890-=oupId
 * @property integer $serviceId
 */
class GroupService extends Model
{

    public $table = 'group_services';
    

    use SoftDeletes;

    public $fillable = [
        'groupId',
        'serviceId', 'created_by',
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
        'serviceId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'serviceId'=>'required',
        'groupId'=>'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function service()
    {
        return $this->belongsTo(Service::class, 'serviceId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function group()
    {
        return $this->belongsTo(Group::class, 'groupId');
    }

    
}
