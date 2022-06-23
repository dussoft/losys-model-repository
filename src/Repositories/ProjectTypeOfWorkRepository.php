<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectTypeOfWork;

/**
 * Class ProjectTypeOfWorkRepository
 * @package App\Repositories
 * @version January 20, 2021, 1:37 pm UTC
*/

class ProjectTypeOfWorkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'typeOfWorkId'
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
        return ProjectTypeOfWork::class;
    }

    public function migrateProjectTypeOfWork($data){
        return ProjectTypeOfBuilding::migrateProjectTypeOfWork($data);
    }
}
