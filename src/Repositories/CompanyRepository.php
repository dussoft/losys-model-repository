<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\Company;
use Referenzverwaltung\Models\GroupCompany;
use Referenzverwaltung\Models\CompanyService;

/**
 * Class CompanyRepository
 * @package App\Repositories
 * @version December 19, 2020, 3:32 pm UTC
*/

class CompanyRepository extends BaseRepository
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
        'groupId'
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
        return Company::class;
    }

    public function loadCompanies($request=[])
    {
        $groupCompanyIds = [];
        $serviceCompanyIds = [];
        $query =  Company::newQuery()->orderBy('id', 'DESC');
        if ($request->groups && count($request->groups) > 0) {
            foreach (GroupCompany::whereIn('groupId', $request->groups)->get() as $groupCompany) {
                array_push($groupCompanyIds, $groupCompany->companyId);
            }
            $groupCompanyIds = array_unique($groupCompanyIds);
            if (count($groupCompanyIds) > 0) {
                $query = $query->whereIn('id', $groupCompanyIds);
            }
        }
        if ($request->services && count($request->services) > 0) {
            foreach (CompanyService::whereIn('serviceId', $request->services)->get() as $companyService) {
                array_push($serviceCompanyIds, $companyService->companyId);
            }
            $serviceCompanyIds = array_unique($serviceCompanyIds);
            if (count($serviceCompanyIds) > 0) {
                $query = $query->whereIn('id', $serviceCompanyIds);
            }
        }
        if ($request->companyIds && count($request->companyIds) > 0) {
            $query = $query->whereIn('id', $request->companyIds);
        }
        if ($request->text-search) {
            $search = $request->get('text-search');
            $query =  $query->where('name', 'LIKE', "%{$search}%");
        }
        if ($request->isSearch) {
            $companies =  $query->orderBy('id', 'DESC')->get();
        } else {
            $companies =  $query->orderBy('id', 'DESC')->paginate(999);
        }
        return $companies;
    }
}
