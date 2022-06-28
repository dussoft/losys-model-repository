<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfConstructionLanguage;

/**
 * Class TypeOfConstructionLanguageRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:23 pm UTC
*/

class TypeOfConstructionLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'typeOfConstrationId',
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
        return TypeOfConstructionLanguage::class;
    }
    public function createorupdate($condition, $data){
        return TypeOfConstructionLanguage::updateOrCreate($condition, $data);
    }

    public function translate($id, $lang){
        return TypeOfConstructionLanguage::translate($id, $lang);
    }
}
