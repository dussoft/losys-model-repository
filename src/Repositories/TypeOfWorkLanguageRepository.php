<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\TypeOfWorkLanguage;

/**
 * Class TypeOfWorkLanguageRepository
 * @package App\Repositories
 * @version December 19, 2020, 3:55 pm UTC
*/

class TypeOfWorkLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'typeOfWorkId',
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
        return TypeOfWorkLanguage::class;
    }
}
