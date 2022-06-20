<?php

namespace Referenzverwaltung\ModelPhoto\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\DefaultTypeOfBuilding;

/**
 * Class DefaultTypeOfBuildingRepository
 * @package App\Repositories
 * @version February 17, 2021, 8:53 am UTC
*/

class DefaultTypeOfBuildingRepository extends BaseRepository
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
        return DefaultTypeOfBuilding::class;
    }
}
