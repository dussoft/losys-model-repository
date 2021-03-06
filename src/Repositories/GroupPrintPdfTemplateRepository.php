<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Models\GroupPrintPdfTemplate;

/**
 * Class PrintPdfTemplateRepository
 * @package Referenzverwaltung\Repositories
 * @version July 26, 2021, 1:40 pm UTC
*/

class GroupPrintPdfTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'cssFileName',
        'isDefault',
        'type'
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
        return GroupPrintPdfTemplate::class;
    }

    public function getById($groupCompanyIds, $type){
        return GroupPrintPdfTemplate::whereIn('groupId',$groupCompanyIds)->where('type',$type)->first();
    }

    public function getByGroupId($groupId){
        return GroupPrintPdfTemplate::where('groupId', $groupId)->get();
    }

    public function getByGroupIdAndDefault($groupId, $default){
        return GroupPrintPdfTemplate::where('groupId', $groupId)->where('isDefault', $default)->get();
    }
}
