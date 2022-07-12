<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Transalation;

/**
 * Class TransalationRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 2:33 pm UTC
*/

class TransalationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
        'languageId'
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
        return Transalation::class;
    }
}
