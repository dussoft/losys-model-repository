<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\Vistors;

/**
 * Class VistorsRepository
 * @package App\Repositories
 * @version June 12, 2020, 10:20 pm UTC
*/

class VistorsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ip_address',
        'browser',
        'device',
        'current_location',
        'language',
        'country',
        'city',
        'state',
        'root',
        'https',
        'activity',
        'platform',
        'browser_version',
        'device_version',
        'lat',
        'lon'
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
        return Vistors::class;
    }
}
