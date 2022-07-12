<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Canton;

/**
 * Class CantonRepository
 * @package Referenzverwaltung\Repositories
 * @version June 3, 2021, 11:21 am UTC
*/

class CantonRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'short_name',
        'de',
        'fr',
        'it',
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
        return Canton::class;
    }

    public function getByName($cantonname){
        return Canton::where('de', $cantonname)->orwhere('en', $cantonname)->orwhere('fr', $cantonname)->orwhere('it', $cantonname)->first();
    }

    public function updateOrCreate($cond, $data){
        return  Canton::updateOrCreate($cond,$data);
    }
}
