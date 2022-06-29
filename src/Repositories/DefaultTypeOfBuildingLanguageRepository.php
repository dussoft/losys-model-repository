<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\DefaultTypeOfBuildingLanguage;

/**
 * Class DefaultTypeOfBuildingRepository
 * @package App\Repositories
 * @version February 17, 2021, 8:53 am UTC
*/

class DefaultTypeOfBuildingLanguageRepository extends BaseRepository
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
        return DefaultTypeOfBuildingLanguage::class;
    }

    public function getByLangAndTypeOfBuildingId($lang, $typeOfBuildingId){
        return  DefaultTypeOfBuildingLanguage::where('languageId', $lang)->where('typeOfBuildingId', $typeOfBuildingId)->first();
    }

    public function getByTypeOfBuildingId($typeOfBuildingId){
        return DefaultTypeOfBuildingLanguage::where('typeOfBuildingId', $typeOfBuildingId)->get();
    }
}
