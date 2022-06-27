<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\ProjectVideo;

/**
 * Class ProjectVideoRepository
 * @package App\Repositories
 * @version December 21, 2020, 8:00 am UTC
*/

class ProjectVideoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projectId',
        'embbedIframe',
        'isMainVideo'
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
        return ProjectVideo::class;
    }

    public function getByProjectId($projectId){
        return ProjectVideo::where('projectId',$projectId)->get();
    }

    public function replicate($id, $cloneProjectId){
        $projectVideo=ProjectVideo::where("id", $id)->first();
        $cloneProjectVideo = $projectVideo->replicate();
        $cloneProjectVideo->projectId = $cloneProjectId;
        $cloneProjectVideo->save();
    }

}
