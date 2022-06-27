<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectImage;

/**
 * Class ProjectImageRepository
 * @package App\Repositories
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

    public function migrateProjectImage($company,$projectImage){
        return ProjectImage::migrateProjectImage($company,$projectImage);
    }

    public function getMainForProject($projectId){
        return ProjectImage::where('projectId',$projectId)->where('isMainImage',1)->orderBy('id','asc')->first();
    }

    public function getByProjectId($projectId){
        return ProjectImage::where('projectId',$projectId)->get();
    }

    public function getProjectImagesWithLosysRights($project, $refoCompanyId){
        ProjectImage::where('projectId',$project->id)->where(
            function($query) use ($refoCompanyId) {
                $query->where('imageRights','losys')
                    ->where('imageSource','losys.fotos-')
                    ->orWhere('imageSource','like',$refoCompanyId.'-%')
                    ->orWhere('imageRights',null);
            }
        )->get();
    }

    public function replicate($id, $cloneProjectId){
        $projectImage=ProjectImage::where("id", $id)->first();
        $cloneProjectImage = $projectImage->replicate();
        $cloneProjectImage->projectId = $cloneProjectId;
        $cloneProjectImage->save();
        return $cloneProjectImage;
    }
}

