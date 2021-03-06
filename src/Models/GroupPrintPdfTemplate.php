<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class PrintPdfTemplate
 * @package Referenzverwaltung\Models
 * @version July 26, 2021, 1:40 pm UTC
 *
 * @property string $title
 * @property string $cssFileName
 * @property boolean $isDefault
 * @property string $type
 */
class GroupPrintPdfTemplate extends Model
{


    public $table = 'group_print_pdf_templetes';
    
    use SoftDeletes;


    public $fillable = [
        'title',
        'cssFileName',
        'isDefault',
        'type',
        'groupId',
        'companyBladePdfGenerator',
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
        'title' => 'string',
        'cssFileName' => 'string',
        'isDefault' => 'boolean',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
