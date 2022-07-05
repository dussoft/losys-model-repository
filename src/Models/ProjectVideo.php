<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectVideo
 * @package App\Models
 * @version December 21, 2020, 8:00 am UTC
 *
 * @property integer $projectId
 * @property string $embbedIframe
 * @property string $isMainVideo
 */
class ProjectVideo extends Model
{

    public $table = 'project_videos';
    use SoftDeletes;



    public $fillable = [
        'projectId',
        'embbedIframe',
        'isMainVideo',
        'ordering',
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
        'projectId' => 'integer',
        'isMainVideo' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
