<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectImage
 * @package App\Models
 * @version December 21, 2020, 7:58 am UTC
 *
 * @property integer $projectId
 * @property string $imageUrl
 * @property string $isMainImage
 */
class ProjectImage extends Model
{

    public $table = 'project_images';

    use SoftDeletes;


    public $fillable = [
        'projectId',
        'imageUrl',
        'extralarge_image',
        'large_image',
        'medium_image',
        'small_image',
        'imageRights',
        'imageSource',
        'isMainImage',
        'old_image_id',
        'created_by',
        'deleted_by',
        'imageCaption'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'projectId' => 'integer',
        'imageUrl' => 'string',
        'isMainImage' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

}
