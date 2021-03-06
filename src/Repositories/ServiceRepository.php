<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Service;
/**
 * Class ServiceRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 3:05 pm UTC
*/

class ServiceRepository extends BaseRepository
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
        return Service::class;
    }
}
