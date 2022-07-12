<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\DefaultTypeOfWork;

/**
 * Class DefaultTypeOfWorkRepository
 * @package Referenzverwaltung\Repositories
 * @version February 17, 2021, 7:47 am UTC
*/

class DefaultTypeOfWorkRepository extends BaseRepository
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
        return DefaultTypeOfWork::class;
    }
}
