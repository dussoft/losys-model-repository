<?php

namespace Referenzverwaltung\Repositories;

use Referenzverwaltung\Repositories\BaseRepository;
use Referenzverwaltung\Models\CategoryLanguage;

/**
 * Class CategoryLanguageRepository
 * @package App\Repositories
 * @version November 23, 2021, 5:09 pm UTC
*/

class CategoryLanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'categoryId',
        'title'
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
        return CategoryLanguage::class;
    }

    public function getLanguagesById($id){
        return DB::table('category_languages')
        ->join('categories', 'categories.id', '=', 'category_languages.categoryId')
        ->join('languages', 'languages.id', '=', 'category_languages.languageId')
        ->where('category_languages.categoryId', '=', $id)
        ->orderBy('languages.isDefault', 'DESC')
        ->groupBy(['category_languages.id']);
    }

    public function getByLangAndCategory($lang, $categoryId){
        return CategoryLanguage::where('languageId',$lang)->where('categoryId', $categoryId)->first();
    }

    public function getByLanguageId($lang){
        return CategoryLanguage::where('languageId',$lang)->get();
    }
}
