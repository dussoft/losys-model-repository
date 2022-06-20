<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectAttribute
 * @package App\Models
 * @version December 21, 2020, 7:56 am UTC
 *
 * @property \App\Models\Project $project
 * @property integer $projectId
 * @property string $type
 */
class ProjectAttribute extends Model
{

    public $table = 'project_attributes';
    

    use SoftDeletes;


    public $fillable = [
        'companyId',
        'type',
        'subtype',
        'view_web',
        'view_datenblatt_extern',
        'view_datenblatt_intern',
        'orderingId',
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
        'companyId' => 'integer',
        'subtype' => 'string'
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
    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project');
    }
}
