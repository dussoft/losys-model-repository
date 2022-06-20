<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\CompanyEmployee;


/**
 * Class CompanyEmployeeRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:28 pm UTC
*/

class CompanyEmployeeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'firstName',
        'lastName',
        'phone',
        'mobile',
        'email',
        'language',
        'userId',
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
        return CompanyEmployee::class;
    }
}
