<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\CompanyService;

/**
 * Class CompanyServiceRepository
 * @package Referenzverwaltung\Repositories
 * @version January 7, 2021, 10:50 am UTC
*/

class CompanyServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'companyId',
        'serviceId'
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
        return CompanyService::class;
    }
}
