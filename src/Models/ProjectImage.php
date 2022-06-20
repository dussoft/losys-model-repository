<?php

namespace Referenzverwaltung\Models;

use Eloquent as Model;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectImage
 * @package App\Models
 * @version December 21, 2020, 7:58 am UTC
 *
 * @property integer $projectId
 * @property string $imageUrl
 * @property string $isMainImage
 */
class ProjectImage extends Model
{

    public $table = 'project_images';

    use SoftDeletes;


    public $fillable = [
        'projectId',
        'imageUrl',
        'extralarge_image',
        'large_image',
        'medium_image',
        'small_image',
        'imageRights',
        'imageSource',
        'isMainImage',
        'old_image_id',
        'created_by',
        'deleted_by',
        'imageCaption'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'projectId' => 'integer',
        'imageUrl' => 'string',
        'isMainImage' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    //migrateProjectImage
    public static function  migrateProjectImage($company,$data)
    {
        $project = Project::where('companyId',$company->id)->where('refo_project_id', $data['old_project_id'])->first();

        if ($project) {

            // Remote image URL

            $xlPath = '/images/projects/' . $project->id . '/XL';
            $lPath = '/images/projects/' . $project->id . '/L';
            $mPath = '/images/projects/' . $project->id . '/M';
            $sPath = '/images/projects/' . $project->id . '/S';
            if(isset($data['medium_image']) && self::checkFileExists($data['medium_image'])){
                //check files
                $fileName=$data['new_filename'];
                $extraToCheck=ProjectImage::checkPath($data['extralarge_image'], $xlPath, $fileName);
                $largeToCheck=ProjectImage::checkPath($data['large_image'], $lPath,$fileName);
                $mediumToCheck=ProjectImage::checkPath($data['medium_image'], $mPath, $fileName);
                $smallToCheck=ProjectImage::checkPath($data['small_image'], $sPath, $fileName);

                $imgCheck=ProjectImage::where('imageUrl', $mediumToCheck)->first();

                if($imgCheck){
                    //if $imgCheck old_image_id is different & rename image
                    //otherwise delete the image and save the new one
                    if($imgCheck->old_image_id != $data['old_image_id']){
                        $fileName=random_int(100000, 999999)."_".$fileName;
                    }
                    else{
                        //delete images
                        if(file_exists($extraToCheck)){
                            unlink($extraToCheck);
                        }
                        if(file_exists($largeToCheck)){
                            unlink($largeToCheck);
                        }
                        if(file_exists($mediumToCheck)){
                            unlink($mediumToCheck);
                        }
                        if(file_exists($smallToCheck)){
                            unlink($smallToCheck);
                        }
                        if(file_exists($imgCheck->extralarge_image)){
                            unlink($imgCheck->extralarge_image);
                        }
                        if(file_exists($imgCheck->large_image)){
                            unlink($imgCheck->large_image);
                        }
                        if(file_exists($imgCheck->medium_image)){
                            unlink($imgCheck->medium_image);
                        }
                        if(file_exists($imgCheck->small_image)){
                            unlink($imgCheck->small_image);
                        }
                    }

                }

                \Log::info("naming complete ".$fileName );

                $extralarge_image = ProjectImage::uploadImageUrl($data['extralarge_image'], $xlPath, $fileName);
                $large_image      = ProjectImage::uploadImageUrl($data['large_image'], $lPath,$fileName);
                $medium_image      = ProjectImage::uploadImageUrl($data['medium_image'], $mPath, $fileName);
                $small_image      = ProjectImage::uploadImageUrl($data['small_image'], $sPath, $fileName);


                ProjectImage::updateOrCreate(['old_image_id' => $data['old_image_id'],'projectId' => $project->id], [
                    'projectId' => $project->id,
                    'imageUrl' => $medium_image,
                    'extralarge_image' => $extralarge_image,
                    'large_image' => $large_image,
                    'medium_image' => $medium_image,
                    'small_image' => $small_image,
                    'imageSource'=>$data['imageSource'],
                    'imageRights'=>$data['imageRights'],
                    'isMainImage' => true,
                    'old_image_id' => $data['old_image_id']
                ]);
            }
        }
    }

    public static function uploadImageUrl($url, $path, $new_filename)
    {
        set_time_limit(10000);

        // Image path
            if(self::checkFileExists($url)){

                $dir = public_path($path);

                if (!File::exists($dir)) {
                    File::makeDirectory($dir, $mode = 0755, true, true);
                }

                $file_name =$new_filename;
                $p =  public_path($path) . '/' . $file_name;

                file_put_contents($p, file_get_contents($url));


            return $path . '/' . $file_name;
        }
        return false;
    }

    public static function checkPath($url, $path, $new_filename)
    {
        if(self::checkFileExists($url)){
            $dir = public_path($path);
            if (!File::exists($dir)) {
                File::makeDirectory($dir, $mode = 0755, true, true);
            }
            $file_name =$new_filename;
            $p =  public_path($path) . '/' . $file_name;
            return $path . '/' . $file_name;
        }
        return false;
    }

    static function  checkFileExists($url)
    {
        $headers = @get_headers($url);
        if($headers[0] == 'HTTP/1.1 404 Not Found') {
            return false;
        }else{
            return true;
        }
    }
}
