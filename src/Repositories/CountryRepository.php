<?php

namespace Referenzverwaltung\ModelPhoto\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\Country;

/**
 * Class CountryRepository
 * @package App\Repositories
 * @version June 3, 2021, 12:36 pm UTC
*/

class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'short_name',
        'de',
        'en'
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
        return Country::class;
    }
}
