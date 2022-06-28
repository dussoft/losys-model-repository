<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfConstruction;
use Referenzverwaltung\Models\DefaultTypeOfConstruction;
use Referenzverwaltung\Models\TypeOfConstructionLanguage;
use Referenzverwaltung\Models\DefaultTypeOfConstructionLanguage;

/**
 * Class TypeOfConstructionRepository
 * @package App\Repositories
 * @version December 19, 2020, 4:10 pm UTC
*/

class TypeOfConstructionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return TypeOfConstruction::class;
    }

    public function saveDefaultForCompany($companyId){
        foreach (DefaultTypeOfConstruction::get() as $defaultTypeOfConstruction) {
            $typeOfConstruction = new TypeOfConstruction(['companyId' => $company->id]);
            $typeOfConstruction->save();
            if ($typeOfConstruction) {
                foreach (DefaultTypeOfConstructionLanguage::where('typeOfConstrationId', $defaultTypeOfConstruction->id)->get() as $defaultTypeOfBuildingLang) {
                    if ($defaultTypeOfBuildingLang) {
                        $typeOfConstructionLang = new TypeOfConstructionLanguage([
                            'typeOfConstrationId' => $typeOfConstruction->id,
                            'languageId' => $defaultTypeOfBuildingLang->languageId,
                            'title' => $defaultTypeOfBuildingLang->title
                        ]);
                        $typeOfConstructionLang->save();
                    }
                }
            }
        }
    }

    public function getByCompanyAndRefoId($companyId, $refoId){
        return TypeOfConstruction::where('companyId', $companyId)->where('refo_type_of_construction_id', $refoId)->first();
    }

    public function createorupdate($condition, $data){
        return TypeOfConstruction::updateOrCreate($condition, $data);
    }

    public function excludeConstructionFromCompany($projectTypeOfContructionId, $companyId){
        return TypeOfConstruction::whereNotIn('id', $projectTypeOfContructionId)->where('companyId', $companyId)->get();
    }
}
