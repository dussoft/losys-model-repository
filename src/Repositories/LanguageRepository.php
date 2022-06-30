<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\Language;

/**
 * Class LanguageRepository
 * @package App\Repositories
 * @version December 19, 2020, 2:14 pm UTC
*/

class LanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'shortName',
        'isDefault'
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
        return Language::class;
    }

    public function createorupdate($condition, $data){
        return Language::updateOrCreate($condition, $data);
    }

    public function getDefaults(){
        return Language::where('isDefault', 1)->get();
    }

    public function findWithTrush($id){
        return Language::withTrashed()->find($id);
    }

    public function getShortnames(){
        return Language::orderBy('shortname', 'asc')->pluck("shortname")->toArray();
    }
}
