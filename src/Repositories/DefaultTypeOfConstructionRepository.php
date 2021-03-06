<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\DefaultTypeOfConstruction;

/**
 * Class DefaultTypeOfConstructionRepository
 * @package Referenzverwaltung\Repositories
 * @version February 17, 2021, 10:34 am UTC
*/

class DefaultTypeOfConstructionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return DefaultTypeOfConstruction::class;
    }
}
