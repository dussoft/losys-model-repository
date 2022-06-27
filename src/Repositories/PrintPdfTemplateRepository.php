<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\PrintPdfTemplate;


/**
 * Class PrintPdfTemplateRepository
 * @package App\Repositories
 * @version July 26, 2021, 1:40 pm UTC
*/

class PrintPdfTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'cssFileName',
        'isDefault',
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
        return PrintPdfTemplate::class;
    }

    public function getByCompanyandType($companyId, $type, $default){
        return PrintPdfTemplate::where('companyId', $companyId)
        ->where('type',$type)
        ->where('isDefault',$default)->first();
    }

    
}
