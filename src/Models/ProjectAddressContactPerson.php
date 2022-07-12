<?php

namespace Referenzverwaltung\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class ProjectAddressContactPerson
 * @package Referenzverwaltung\Models
 * @version March 24, 2021, 6:42 pm UTC
 *
 * @property integer $projectId
 * @property integer $contactPersonId
 */
class ProjectAddressContactPerson extends Model
{


    public $table = 'project_contact_persons';

    use SoftDeletes;


    public $fillable = [
        'projectId',
        'contactPersonId',
        'addressId',
        'refo_contact_person_ids',
        'view_web',
        'view_datenblatt_extern',
        'view_datenblatt_intern',
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
        'contactPersonId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function contactPerson()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\AddressCompanyContactPerson::class, 'contactPersonId');
    }

    public function address()
    {
        return $this->belongsTo(\Referenzverwaltung\Models\Address::class, 'addressId');
    }

    public static function migrateProjectAddressContactPerson($data, $usernames="")
    {
        if (isset($data['reference_addresses'])) {

            if (count($data['reference_addresses']) > 0) {

                foreach ($data['reference_addresses'] as $reference_address) {

                    $address = Address::where('companyId', $data['companyId'])
                        ->where('refo_address_id', $reference_address['refo_address_id'])->first();

                    if ($address) {
                        $addressCompanyContactPerson = AddressCompanyContactPerson::where('addressId', $address->id)
                            ->where('old_contact_person_id', $reference_address['refo_contact_person_id'])->first();

                        if ($addressCompanyContactPerson) {
                            ProjectAddressContactPerson::updateOrCreate(
                                [
                                    'contactPersonId' => $addressCompanyContactPerson->id,
                                    'projectId' => $data['projectId']
                                ],
                                [
                                'contactPersonId' =>$addressCompanyContactPerson->id,
                                'addressId'=>$address->id,
                                'projectId' => $data['projectId'],
                                'view_datenblatt_intern'=>1,
                                'refo_contact_person_id' => $reference_address['refo_contact_person_id'],
                                'created_by'=>$usernames
                            ]);
                        }else{
                            //addressId
                            ProjectAddressContactPerson::updateOrCreate(
                                [
                                    'addressId' => $address->id,
                                    'projectId' => $data['projectId']
                                ],
                                [
                                'addressId'=>$address->id,
                                'projectId' => $data['projectId'],
                                'view_datenblatt_intern'=>1,
                                'created_by'=>$usernames
                            ]);
                        }
                    }
                }
            }
        }
    }
}
