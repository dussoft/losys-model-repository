<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use App\User;
use \App\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Company
 * @package App\Models
 * @version December 19, 2020, 3:32 pm UTC
 *
 * @property \App\Models\Group $groupid
 * @property string $status
 * @property string $name
 * @property string $alternativeName
 * @property string $mailBox
 * @property string $address
 * @property string $zipcode
 * @property string $city
 * @property string $country
 * @property integer $groupId
 */
class Company extends Model
{

    public $table = 'companies';
    
    use SoftDeletes;


    public $fillable = [
        'status',
        'name',
        'alternativeName',
        'mailBox',
        'address',
        'zipcode',
        'city',
        'phone',
        'fax',
        'email',
        'website',
        'geolocationX',
        'geolocationY',
        'logoUrl',
        'country',
        'refo_company_id',
        'language',
        'numberOfUser', 
        'socialMedia',
        'created_by',
        'deleted_by',
        'css_file',
        'auto_import',
        'auto_update',
        'js_file'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'string',
        'name' => 'string',
        'alternativeName' => 'string',
        'mailBox' => 'string',
        'address' => 'string',
        'zipcode' => 'string',
        'city' => 'string',
        'country' => 'string',
        'groupId' => 'integer',
        'phone' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'website' => 'string',
        'geolocationX' => 'string',
        'geolocationY' => 'string',
        'logoUrl' => 'string',
        'language'=>'string',
        'numberOfUser'=>'integer',
        'socialMedia'=>'string',
        'css_file'=>'string',
        'js_file'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'city' => 'required',
        'country' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function groups()
    {
        return $this->belongsToMany(GroupCompany::class, 'groupId');
    }

    public static function setActiveCompanyId($id){
        return session(['activeCompany' => $id]);
    }

    public static function getActiveCompanyId():int{
        return (int)session()->get('activeCompany');
    }

    public static function getUserCompany():int{
        if(User::userHasCompany()){
            return Auth::user()->company->id;
        }
        return 0;
    }

    public static function userCompany(){
        
        return self::getActiveCompanyId() > 0?Company::find(self::getActiveCompanyId()):null;
    }
    public static  function addOrUpdateActiveCompany(int $id = null):void
    {
        if(isset($id)){ 
            if(UserRole::isAdmin() || UserRole::isSuperAdmin()){
                self::setActiveCompanyId($id);  
            }
            else{
                if(User::userHasCompany()){
                    if(Auth::user()->company->id==$id){
                        self::setActiveCompanyId($id);
                    }
                    else{
                        $userRightToEdit=[];
                        $groupId=\App\Models\GroupCompany::where('companyId',Auth::user()->company->id)->pluck('groupId');
                        $companiesIds=\App\Models\GroupCompany::whereIn('groupId',$groupId)->pluck('companyId');
                        $companies=\App\Models\Company::whereIn('id',$companiesIds)->get();
                        foreach($companies as $company){
                            $groupMember=\App\Models\GroupRight::where('memberId', Auth::user()->id)->where('companyId',$company->id)->first();
                            if(isset($groupMember) && $groupMember->enable_print_edit){
                                $userRightToEdit[]=$company->id;
                            }
                        }
                        if(in_array($id, $userRightToEdit)){
                            self::setActiveCompanyId($id);
                        }
                    }
                }
            }
        }
        else{
            if(User::userHasCompany())
                { self::setActiveCompanyId(Auth::user()->company?Auth::user()->company->id:0); }
                
        }
    }
}
