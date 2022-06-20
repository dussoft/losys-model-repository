<?php

namespace Referenzverwaltung\ModelPhoto\Repositories;

use Referenzverwaltung\Interfaces\AddressCompanyContactPerson;
use Referenzverwaltung\Models\BaseRepository;

/**
 * Class AddressCompanyContactPersonRepository
 * @package App\Repositories
 * @version January 26, 2021, 5:07 pm UTC
*/

class AddressCompanyContactPersonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'firstName',
        'lastName',
        'function',
        'phone',
        'mobile',
        'email',
        'gender',
        'yearOfBirth',
        'education',
        'status',
        'skills',
        'addressId',
        'avatar'
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
        return AddressCompanyContactPerson::class;
    }
}
