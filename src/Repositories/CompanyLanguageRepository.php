<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\CompanyLanguage;

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
        return CompanyLanguage::class;
    }

    public function getByCompanyId($companyId){
        return CompanyLanguage::where('companyId',$companyId)->get();
    }

    public function getByLanguageId($languageId){
        return CompanyLanguage::where('languageId',$languageId)->get();
    }
    
}
