<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class PrintPdfTemplate
 * @package App\Models
 * @version July 26, 2021, 1:40 pm UTC
 *
 * @property string $title
 * @property string $cssFileName
 * @property boolean $isDefault
 * @property string $type
 */
class PrintPdfTemplate extends Model
{


    public $table = 'print_pdf_templetes';
    use SoftDeletes;



    public $fillable = [
        'title',
        'cssFileName',
        'isDefault',
        'type',
        'companyId',
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
