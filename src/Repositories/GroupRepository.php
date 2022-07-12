<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Group;

/**
 * Class GroupRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 3:04 pm UTC
*/

class GroupRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Group::class;
    }
}
