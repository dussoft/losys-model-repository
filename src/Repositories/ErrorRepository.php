<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Error;

class ErrorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'error',
        'description'
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
        return Error::class;
    }

    public function clearall(){
        foreach(Error::get() as $error){
            $error->delete();
        }
    }
}
