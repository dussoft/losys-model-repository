<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\IframeTemplate;

/**
 * Class IframeTemplateRepository
 * @package App\Repositories
 * @version August 1, 2021, 10:25 am UTC
*/

class IframeTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'layout',
        'companyId',
        'link'
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
        return IframeTemplate::class;
    }

    public function getForCompany($companyId)
    {
        return IframeTemplate::where("companyId", $companyId)->get();
    }

    public function getByCompanyAndLayout($companyId, $layout){
        return IframeTemplate::where("companyId", $companyId)->where("layout", $layout)->first();
    }

    public function createorupdate($condition, $data){
        return IframeTemplate::updateOrCreate($condition, $data);
    }

    public function getByCompany($companyId){
        return IframeTemplate::where('companyId', $companyId)->get();
    }

    public function getFirstByCompany($companyId){
        return IframeTemplate::where('companyId', $companyId)->first();
    }

    public function getByLink($embedLink){
        return IframeTemplate::where('link',$embedLink)->first();
    }
}
