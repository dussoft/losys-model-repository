<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\Address;
use Referenzverwaltung\Models\Project;
use Referenzverwaltung\Models\ProjectParticipatingCompany;

/**
 * Class AddressRepository
 * @package Referenzverwaltung\Repositories
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

    public function getIdsByCompanyId($companyId){
       return Address::where('companyId', $companyId)->pluck('id');
    }

    public function loadAddresses($companyId, $status, $country, $textSearch, $isSearch)
    {
        $query =  Address::where('companyId', $companyId)->orderBy('name','ASC');
        if ($status) {
            $query = $query->where('status', $status);
        }
        if ($country) {
            $query = $query->where('country', $country);
        }
        if ($textSearch) {
            $fullsearch = $textSearch;
            $words = preg_split('/[\ \n\,]+/', $fullsearch);
            foreach($words as $wrd){
                $search = BaseRepository::escape_like($wrd);
                $query= $query->where(function($query) use ($search) {
                    $query=$query->where('name', 'LIKE',"%{$search}%")
                            ->orWhere('address', 'LIKE', "%{$search}%")
                            ->orWhere('zipcode', 'LIKE', "%{$search}%")
                            ->orWhere('city', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->orWhere('website', 'LIKE', "%{$search}%")
                            ->orWhereHas('contactPerson', function ($query) use ($search) {
                                $query->where('firstName', 'LIKE', "%{$search}%")
                                ->orWhere('lastName', 'LIKE', "%{$search}%")
                                ->orWhere('email', 'LIKE', "%{$search}%");
                            });
                });
            }
        }
        if($isSearch) {
            $addresses =  $query->where('companyId', $companyId)->orderBy('name','ASC')->get();
        } else {
            $addresses =  $query->where('companyId', $companyId)->orderBy('name','ASC')->paginate(8);
        }
        return $addresses;
    }

    public function loadUnusedAddresses($companyId, $status, $country, $textSearch, $isSearch)
    {
        $query =  Address::where('companyId', $companyId)->orderBy('name','ASC');
        if ($status) {
            $query = $query->where('status', $status);
        }
        if ($country) {
            $query = $query->where('country', $country);
        }
        if ($textSearch) {
            $search = $textSearch;
            $query =  $query->where('name', 'LIKE', "%" . BaseRepository::escape_like($textSearch) . "%");
        }
        $prokectId=Project::where('companyId', $companyId)->pluck('id');
        $addressId=ProjectParticipatingCompany::whereIn('projectId',$prokectId)->pluck('addressId');
        if ($isSearch) {
            $addresses =  $query->where('companyId', $companyId)
            ->whereNotIn('id',$addressId)->orderBy('name','ASC')->get();
        } else {
            $addresses =  $query->where('companyId', $companyId)
            ->whereNotIn('id',$addressId)->orderBy('name','ASC')->paginate(8);
        }
        return $addresses;
    }

    public function getByCompanyExcludeIds($companyId, $ids, $order="ASC"){
        return Address::where('companyId', $companyId)
        ->whereNotIn('id',$ids)->orderBy('name',$order)->get();
    }

    public function getIdsByNameAndCompany($companyIds, $search){
        return Address::whereIn('companyId', $companyIds)->where('name', 'like', "%" . BaseRepository::escape_like(
                                                                           $search) . "%")->pluck('id');
    }
}
