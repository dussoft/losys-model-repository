<?php

namespace Referenzverwaltung\ModelPhoto\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\ProjectImage;

/**
 * Class ProjectImageRepository
 * @package App\Repositories
 * @version December 21, 2020, 7:58 am UTC
*/

class ProjectImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'imageUrl',
        'isMainImage'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProjectImage::class;
    }
}
