<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class IframeTemplate
 * @package Referenzverwaltung\Models
 * @version August 1, 2021, 10:25 am UTC
 *
 * @property string $title
 * @property string $layout
 * @property integer $companyId
 * @property string $link
 */
class IframeTemplate extends Model
{


    public $table = 'iframe_templates';
    
    use SoftDeletes;


    public $fillable = [
        'title',
        'layout',
        'companyId',
        'link',
        'cssFileName',
        'isMapVisible',
        'isSearchBoxVisible',
        'isPdfVisible',
        'display', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'layout' => 'string',
        'companyId' => 'integer',
        'link' => 'string',
        'display'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'layout' => 'required',
        'companyId' => 'required'
    ];

    
}
