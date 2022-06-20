<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectTypeOfContruction;

/**
 * Class ProjectTypeOfContructionRepository
 * @package App\Repositories
 * @version February 18, 2021, 8:17 am UTC
*/

class ProjectTypeOfContructionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'typeOfContructionId'
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
        return ProjectTypeOfContruction::class;
    }
}
