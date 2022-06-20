<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class CompanyService
 * @package App\Models
 * @version January 7, 2021, 10:50 am UTC
 *
 * @property integer $companyId
 * @property integer $serviceId
 */
class CompanyService extends Model
{


    use SoftDeletes;

    public $table = 'company_services';
    



    public $fillable = [
        'companyId',
        'serviceId', 'created_by',
        'deleted_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'companyId' => 'integer',
        'serviceId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'companyId' => 'required',
        'serviceId' => 'required'
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'companyId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class, 'serviceId');
    }

    public static function data()
    {
        $companiesIds = Company::pluck('id');

        if(count($companiesIds) > 0){

            $serviceIds = CompanyService::whereIn('companyId',$companiesIds)->pluck('serviceId');

            if(count($serviceIds) > 0){
                return Service::whereIn('id',$serviceIds)->get();
            }

        }
        return [];
    }
}
