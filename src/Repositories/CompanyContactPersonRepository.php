<?php

namespace Referenzverwaltung\ModelPhoto\Repositories;

use Referenzverwaltung\Interfaces\BaseRepository;
use Referenzverwaltung\Models\CompanyContactPerson;

/**
 * Class CompanyContactPersonRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:57 pm UTC
*/

class CompanyContactPersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firstName',
        'name',
        'lastName',
        'function',
        'phone',
        'mobile',
        'email',
        'state',
        'emailOption',
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
        return CompanyContactPerson::class;
    }
}
