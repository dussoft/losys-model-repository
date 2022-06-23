<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\TypeOfWork;
use Referenzverwaltung\Models\DefaultTypeOfWork;
use Referenzverwaltung\Models\TypeOfWorkLanguage;
use Referenzverwaltung\Models\DefaultTypeOfWorkLanguage;

/**
 * Class TypeOfWorkRepository
 * @package App\Repositories
 * @version December 19, 2020, 3:49 pm UTC
*/

class TypeOfWorkRepository extends BaseRepository
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
        return TypeOfWork::class;
    }

    public function saveDefaultForCompany($companyId){
        foreach (DefaultTypeOfWork::get() as $defaultTypeOfWork) {
            $typeOfWork = new TypeOfWork(['companyId' => $companyId]);
            $typeOfWork->save();
            if ($typeOfWork) {
                foreach (DefaultTypeOfWorkLanguage::where('typeOfWorkId', $defaultTypeOfWork->id)->get() as $defaultTypeOfWorkLang) {
                    if ($defaultTypeOfWorkLang) {
                        $typeOfWorkLang = new TypeOfWorkLanguage([
                            'typeOfWorkId' => $typeOfWork->id,
                            'languageId' => $defaultTypeOfWorkLang->languageId,
                            'title' => $defaultTypeOfWorkLang->title
                        ]);
                        $typeOfWorkLang->save();
                    }
                }
            }
        }
    }

    public function getByCompanyAndRefoId($companyId, $refoId){
        return TypeOfWork::where('companyId', $companyId)->where('refo_type_of_work_id', $refoId)->first();
    }

    public function createorupdate($condition, $data){
        return TypeOfWork::updateOrCreate($condition, $data);
    }
}
