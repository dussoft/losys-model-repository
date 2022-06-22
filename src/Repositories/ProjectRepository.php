<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\Project;

/**
 * Class ProjectRepository
 * @package App\Repositories
 * @version December 19, 2020, 5:02 pm UTC
*/

class ProjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'address',
        'zipcode',
        'city',
        'geolocationX',
        'geolocationY',
        'status',
        'title',
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
        return Project::class;
    }

    public function autoImport($url){
        $donwloadedContent=Project::downloadProjectByUrl($url);
        if(array_key_exists('company', $donwloadedContent)){
            $refo_company= $donwloadedContent['company'];
            if(array_key_exists('refo_company_id', $refo_company)){
                $company=Company::where('refo_company_id',$refo_company['refo_company_id'])->first();
                if($company){
                    app(MigrateOldDataController::class)->migrateCompanies($donwloadedContent, $company, false);
                    return response()->json(['success' => true]);
                }
            }
        }
    }
}
