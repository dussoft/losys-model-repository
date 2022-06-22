<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfBuildingLanguage;

/**
 * Class TypeOfBuildingLanguageRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:07 pm UTC
*/

class TypeOfBuildingLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'typeOfBuildingId',
        'languageId',
        'title'
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
        return TypeOfBuildingLanguage::class;
    }

    public function createorupdate($condion, $data){
        return TypeOfBuildingLanguage::updateOrCreate($condition, $data);
    }
}
