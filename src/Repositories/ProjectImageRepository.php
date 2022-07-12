<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\ProjectImage;

/**
 * Class ProjectImageRepository
 * @package Referenzverwaltung\Repositories
 * @version December 21, 2020, 7:58 am UTC
*/

class ProjectImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'imageUrl',
        'isMainImage'
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
        return ProjectImage::class;
    }

    public function getByImgUrl($url){
        return ProjectImage::where('imageUrl', $url)->first();
    }

    public function updateOrCreate($cond, $data){
        return ProjectImage::updateOrCreate($cond, $data);
    }

    public function getByProjectId($projectId, $isMain){
        return ProjectImage::where('projectId',$projectId)
        ->where('isMainImage',$isMain)
        ->orderBy('id','ASC')->get();
    }

    public function getMaxByIdInf($id, $projectId){
        return ProjectImage::where('id', '<', $id)->where('projectId',$projectId)->max('id');
    }
    public function getMinByIdInf($id, $projectId){
        return ProjectImage::where('id', '<', $id)->where('projectId',$projectId)->min('id');
    }

    public function getMaxByIdSup($id, $projectId){
        return ProjectImage::where('id', '>', $id)->where('projectId',$projectId)->max('id');
    }
    
    public function getMinByIdSup($id, $projectId){
        return ProjectImage::where('id', '>', $id)->where('projectId',$projectId)->min('id');
    }

    public function getMaxSupMain($id, $projectId){
        return ProjectImage::where('id', '<', $id)->where('projectId',$projectId)->where('isMainImage', 1)->max('id');
    }

    public function getMaxSupNotMain($id, $projectId){
        return ProjectImage::where('id', '<', $id)->where('projectId',$projectId)->where('isMainImage', 0)->max('id');
    }

    public function getMaxInfMain($id, $projectId){
        return ProjectImage::where('id', '>', $id)->where('projectId',$projectId)->where('isMainImage', 1)->max('id');
    }

    public function getMaxInfNotMain($id, $projectId){
        return ProjectImage::where('id', '>', $id)->where('projectId',$projectId)->where('isMainImage', 0)->max('id');
    }

    public function getMinSupMain($id, $projectId){
        return ProjectImage::where('id', '<', $id)->where('projectId',$projectId)->where('isMainImage', 1)->min('id');
    }

    public function getMinSupNotMain($id, $projectId){
        return ProjectImage::where('id', '<', $id)->where('projectId',$projectId)->where('isMainImage', 0)->min('id');
    }

    public function getMinInfMain($id, $projectId){
        return ProjectImage::where('id', '>', $id)->where('projectId',$projectId)->where('isMainImage', 1)->min('id');
    }

    public function getMinInfNotMain($id, $projectId){
        return ProjectImage::where('id', '>', $id)->where('projectId',$projectId)->where('isMainImage', 0)->min('id');
    }
}

