<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\MigrateOldData;

/**
 * Class MigrateOldDataRepository
 * @package App\Repositories
 * @version April 27, 2021, 7:50 am UTC
*/

class MigrateOldDataRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'file_name'
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
        return MigrateOldData::class;
    }

    public function createorupdate($condition, $second){
        return MigrateOldData::updateOrCreate($condition, $second);
    }
}
