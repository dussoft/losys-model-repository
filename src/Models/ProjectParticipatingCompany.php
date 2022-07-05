<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ProjectParticipatingCompany
 * @package App\Models
 * @version December 21, 2020, 8:15 am UTC
 *
 * @property integer $projectId
 * @property integer $addressId
 */
class ProjectParticipatingCompany extends Model
{

    public $table = 'project_participating_companies';
    use SoftDeletes;



    public $fillable = [
        'projectId',
        'addressId',
        'view_web',
        'view_datenblatt_extern',
        'view_datenblatt_intern',
        'orderingId',
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
        'projectId' => 'integer',
        'addressId' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function address()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Address::class, 'addressId');
    }
    //


    public function typeOfWorks()
    {
        return $this->hasMany(ProjectParticipatingCompanyInvolved::class, 'participatingCompanyId');
    }

    public static function migrateProjectParticipatingCompany($company,$projectId, $data)
    {
       
        if ($data['participating_companies'] && count($data['participating_companies']) > 0) {

            foreach ($data['participating_companies'] as $participating_company) {
                //refo_address_id
                $address = Address::where('companyId',$company->id)->where('refo_address_id', $participating_company['refo_address_id'])->first();

                if ($address) {

                    $payload = ['projectId' => $projectId, 'addressId' => $address->id, 'view_web' => $participating_company['viewoptions']['view_web'], 'view_datenblatt_extern' => $participating_company['viewoptions']['view_datenblatt_extern'], 'view_datenblatt_intern' => $participating_company['viewoptions']['view_datenblatt_intern']];

                    $projectParticipatingCompany = ProjectParticipatingCompany::updateOrCreate($payload, $payload);
                    ProjectParticipatingCompanyInvolved::migrateProjectParticipatingCompanyInvolved($company,$projectParticipatingCompany->id, $participating_company);
                }
            }
        }
    }
}
