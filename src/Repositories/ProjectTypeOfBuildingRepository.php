<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectTypeOfBuilding;

/**
 * Class ProjectTypeOfBuildingRepository
 * @package App\Repositories
 * @version February 18, 2021, 8:19 am UTC
*/

class ProjectTypeOfBuildingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'typeOfBuildingId',
        'projectId'
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
        return ProjectTypeOfBuilding::class;
    }
}
