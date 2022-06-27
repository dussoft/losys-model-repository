<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\Address;

/**
 * Class AddressRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:50 pm UTC
*/

class AddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'name',
        'alternativeName',
        'mailBox',
        'address',
        'zipcode',
        'city',
        'country',
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
        return Address::class;
    }

    public function getByCompanyAndRefoId($companyId, $refoId){
        return Address::where('companyId', $companyId)->where('refo_address_id', $refoId)->first();
    }

    public function createorupdate($condition, $data){
        return Address::updateOrCreate($condition, $data);
    }

    public function getBycompanyAndIds($companyId, $projectParticipatingCompanyId){
        return Address::whereNotIn('id', $projectParticipatingCompanyId)->where('companyId',  $companyId)->orderBy('name','ASC')->get();
    }
}
