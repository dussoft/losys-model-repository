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

    public function getIdsByCompanyId($companyId){
       return Address::where('companyId', $companyId)->pluck('id');
    }

    public function loadAddresses($request)
    {
        $query =  Address::where('companyId', $request->companyId)->orderBy('name','ASC');
        if ($request->get('status')) {
            $query = $query->where('status', $request->status);
        }
        if ($request->country) {
            $query = $query->where('country', $request->country);
        }
        if ($request->textSearch) {
            $fullsearch = $request->textSearch;
            $words = preg_split('/[\ \n\,]+/', $fullsearch);
            foreach($words as $search){
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
        if($request->get('isSearch')) {
            $addresses =  $query->where('companyId', $request->get("companyId"))->orderBy('name','ASC')->get();
        } else {
            $addresses =  $query->where('companyId', $request->get("companyId"))->orderBy('name','ASC')->paginate(8);
        }
        return $addresses;
    }

    public function loadUnusedAddresses($request)
    {
        $query =  Address::where('companyId', $request->companyId)->orderBy('name','ASC');
        if ($request->status) {
            $query = $query->where('status', $request->status);
        }
        if ($request->get('country')) {
            $query = $query->where('country', $request->country);
        }
        if ($request->textSearch) {
            $search = $request->textSearch;
            $query =  $query->where('name', 'LIKE', "%{$search}%");
        }
        $prokectId=Project::where('companyId', $request->companyId)->pluck('id');
        $addressId=ProjectParticipatingCompany::whereIn('projectId',$prokectId)->pluck('addressId');
        if ($request->isSearch) {
            $addresses =  $query->where('companyId', $request->companyId)
            ->whereNotIn('id',$addressId)->orderBy('name','ASC')->get();
        } else {
            $addresses =  $query->where('companyId', $request->companyId)
            ->whereNotIn('id',$addressId)->orderBy('name','ASC')->paginate(8);
        }
        return $addresses;
    }

    public function getByCompanyExcludeIds($companyId, $ids, $order="ASC"){
        return Address::where('companyId', $companyId)
        ->whereNotIn('id',$ids)->orderBy('name',$order)->get();
    }

    
}
