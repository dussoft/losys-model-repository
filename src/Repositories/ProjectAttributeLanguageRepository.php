<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\ProjectAttributeLanguage;

/**
 * Class ProjectAttributeLanguageRepository
 * @package App\Repositories
 * @version December 21, 2020, 8:28 am UTC
*/

class ProjectAttributeLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectAttributeId',
        'field',
        'value'
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
        return ProjectAttributeLanguage::class;
    }
}
