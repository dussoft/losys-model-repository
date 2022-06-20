<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectProperty;

/**
 * Class ProjectPropertyRepository
 * @package App\Repositories
 * @version December 21, 2020, 8:13 am UTC
*/

class ProjectPropertyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'typeOfBuildingId',
        'yearOfCompletion',
        'projectWebsite',
        'description',
        'visibilityOption'
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
        return ProjectProperty::class;
    }
}
