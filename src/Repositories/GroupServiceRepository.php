<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\GroupService;

/**
 * Class GroupServiceRepository
 * @package App\Repositories
 * @version December 19, 2020, 3:13 pm UTC
*/

class GroupServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'groupId',
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
        return GroupService::class;
    }

    public function getyGroupId($groupId){
        return GroupService::where('groupId',$groupId)->get();
    }
}
