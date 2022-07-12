<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\ProjectProperty;

/**
 * Class ProjectPropertyRepository
 * @package Referenzverwaltung\Repositories
 * @version December 21, 2020, 8:13 am UTC
*/

class ProjectPropertyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'typeOfBuildingId',
        'yearOfCompletion',
        'projectWebsite',
        'description',
        'visibilityOption'
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
        return ProjectProperty::class;
    }

    public function getByProjectId($id){
        return ProjectProperty::where("projectId", $id)->get();
    }

    public function replicate($id, $cloneProjectId){
        $projectProperty=ProjectProperty::where("id", $id)->first();
        $cloneProjectProperty = $projectProperty->replicate();
        $cloneProjectProperty->projectId = $cloneProjectId;
        $cloneProjectProperty->save();
    }

    public function updateOrCreate($cond, $data){
        return ProjectProperty::updateOrCreate($cond, $data);
    }

    public function getValuesFromProjectAttributeId($attributeIds){
        return ProjectProperty::whereIn('projectAttributeId',$attributeIds)->pluck('value');
    }

    public function getFromProjectAttributeId($projectAttributeId){
        return ProjectProperty::whereIn('projectAttributeId',$projectAttributeId)->get();
    }
    
}

