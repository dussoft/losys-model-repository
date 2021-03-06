<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\TypeOfBuilding;
use Referenzverwaltung\Models\DefaultTypeOfBuilding;
use Referenzverwaltung\Models\TypeOfBuildingLanguage;
use Referenzverwaltung\Models\DefaultTypeOfBuildingLanguage;

/**
 * Class TypeOfBuildingRepository
 * @package Referenzverwaltung\Repositories
 * @version December 19, 2020, 3:59 pm UTC
*/

class TypeOfBuildingRepository extends BaseRepository
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
        return TypeOfBuilding::class;
    }

    public function saveDefaultForCompany($companyId){
        foreach (DefaultTypeOfBuilding::get() as $defaultTypeOfBuilding) {
            $typeOfBuilding = new TypeOfBuilding(['companyId' => $companyId]);
            $typeOfBuilding->save();
            if ($typeOfBuilding) {
                foreach (DefaultTypeOfBuildingLanguage::where('typeOfBuildingId', $defaultTypeOfBuilding->id)->get() as $defaultTypeOfBuildingLang) {
                    if ($defaultTypeOfBuildingLang) {
                        $typeOfBuildingLang = new TypeOfBuildingLanguage([
                            'typeOfBuildingId' => $typeOfBuilding->id,
                            'languageId' => $defaultTypeOfBuildingLang->languageId,
                            'title' => $defaultTypeOfBuildingLang->title
                        ]);
                        $typeOfBuildingLang->save();
                    }
                }
            }
        }
    }

    public function getByCompanyAndRefoId($companyId, $refoId){
        return TypeOfBuilding::where('companyId', $companyId)->where('refo_type_of_building_id', $refoId)->first();
    }

    public function createorupdate($condition, $data){
        return TypeOfBuilding::updateOrCreate($condition, $data);
    }

    public function excludeBuildingFromCompany($projectTypeOfBuildingId, $companyId){
        return TypeOfBuilding::whereNotIn('id', $projectTypeOfBuildingId)->where('companyId', $companyId)->get();
    }
}
