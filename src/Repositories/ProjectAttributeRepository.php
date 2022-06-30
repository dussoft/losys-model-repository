<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectAttribute;

/**
 * Class ProjectAttributeRepository
 * @package App\Repositories
 * @version December 21, 2020, 7:56 am UTC
*/

class ProjectAttributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'type'
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
        return ProjectAttribute::class;
    }

    public function getByCompanyId($id){
        return ProjectAttribute::where('companyId',$id)->orderBy('orderingId','asc')->get();
    }

    public function getByCompanyAndOrder($companyId, $order){
        return ProjectAttribute::where('companyId',$companyId)->orderBy('orderingId',$order)->get();
    }

    public function getFirstByCompanyAndOrder($companyId, $order){
        return ProjectAttribute::where('companyId',$companyId)->orderBy('orderingId',$order)->first();
    }
}
