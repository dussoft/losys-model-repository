<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectAttributeLanguage;

/**
 * Class ProjectAttributeLanguageRepository
 * @package App\Repositories
 * @version December 21, 2020, 8:28 am UTC
*/

class ProjectAttributeLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectAttributeId',
        'field',
        'value'
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
        return ProjectAttributeLanguage::class;
    }

    public function getByLanguageId($id){
        return ProjectAttributeLanguage::where("languageId", $id)->get();
    }

    public function getLangForAttribute($id){
        return DB::table('project_attribute_languages')
        ->join('project_attributes', 'project_attributes.id', '=', 'project_attribute_languages.projectAttributeId')
        ->join('languages', 'languages.id', '=', 'project_attribute_languages.languageId')
        ->where('project_attribute_languages.projectAttributeId', '=',$id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['project_attribute_languages.id']);
    }
    
    public function getByLangAndProjectAttrib($languageId, $projectAttributeId){
        return ProjectAttributeLanguage::where('languageId',$languageId)->where('projectAttributeId', $projectAttributeId)->first();
    }

    public function getByProjectAttributeId($projectAttributeId){
        return ProjectAttributeLanguage::where('projectAttributeId',$projectAttributeId)->get();
    }
}
