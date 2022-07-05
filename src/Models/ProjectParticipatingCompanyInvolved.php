<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ProjectParticipatingCompanyInvolved
 * @package App\Models
 * @version December 21, 2020, 8:18 am UTC
 *
 * @property integer $projectParticipatingCompanyId
 * @property integer $typeOfWorkId
 */
class ProjectParticipatingCompanyInvolved extends Model
{

    public $table = 'participating_company_involved';

    use SoftDeletes;


    public $fillable = [
        'participatingCompanyId',
        'typeOfWorkId',
        'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'participatingCompanyId' => 'integer',
        'typeOfWorkId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public static function migrateProjectParticipatingCompanyInvolved($company,$participatingCompanyId, $data)
    {
        if ($data['refo_type_of_work_ids']) {

            $refo_type_of_work_ids = explode(',', $data['refo_type_of_work_ids']);

            if ($refo_type_of_work_ids && count($refo_type_of_work_ids) > 0) {
                foreach ($refo_type_of_work_ids as $refo_type_of_work_id) {
                    $typeOfWork = TypeOfWork::where('companyId',$company->id)->where('refo_type_of_work_id', $refo_type_of_work_id)->first();
                    if ($typeOfWork) {
                        $payload = ['participatingCompanyId' => $participatingCompanyId, 'typeOfWorkId' => $typeOfWork->id];
                        ProjectParticipatingCompanyInvolved::updateOrCreate($payload, $payload);
                    }
                }
            }
        }
    }
}
