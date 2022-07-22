<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\User;

/**
 * Class UserRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 3:49 pm UTC
*/

class UserRepository extends BaseRepository
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
        return User::class;
    }

    public function getByEmail($email){
        return User::where('email', $email)->first();
    }
    
}
