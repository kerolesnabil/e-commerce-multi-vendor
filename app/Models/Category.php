<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    protected $translatedAttributes = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'slug', 'is_active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function getActive(){
        return  $this -> is_active  == 0 ?  __('admin/general.not active')  :__('admin/general.active') ;
    }

    public function _parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function scopeActive($query){
        return $query -> where('is_active',1) ;
    }

    public function children()
    {
        return $this->hasMany(Category::class, "parent_id")->with(["children"=> function($query){
            return $query->with("children");
        }]);
    }

    public static function treeCrate()
    {
        $allCategories = Category::active()->get();

        $rootCategories = $allCategories->whereNull('parent_id');

        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    public static function treeUpdate($id)
    {
        $allCategories = Category::where('id','<>',$id)->active()->get();

        $rootCategories = $allCategories->whereNull('parent_id');
        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    private static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();

            if ($category->children->isNotEmpty()) {
                self::formatTree($category->children, $allCategories);
            }
        }
    }

    public function products()
    {
        return $this -> belongsToMany(Product::class,'product_categories');
    }


}
