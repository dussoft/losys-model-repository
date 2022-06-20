<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\ProjectAddressContactPerson;

/**
 * Class ProjectAddressContactPersonRepository
 * @package App\Repositories
 * @version March 24, 2021, 6:42 pm UTC
*/

class ProjectAddressContactPersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'contactPersonId'
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
        return ProjectAddressContactPerson::class;
    }
}
