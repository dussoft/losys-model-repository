<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfConstruction;

/**
 * Class TypeOfConstructionRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:10 pm UTC
*/

class TypeOfConstructionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'companyId'
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
        return TypeOfConstruction::class;
    }
}
