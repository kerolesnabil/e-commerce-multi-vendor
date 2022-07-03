<?php

    define('PAGINATION_COUNT', 10);
    function getFolder()
    {
        return app()->getLocale()==='ar' ?'css-rtl':'css';
    }

    function uploadImage($folder,$image){
        $image->store('/', $folder);
        $filename =$image->hashName();
        return  $filename;
    }
    function deleteImage($folder,$image)
    {
        \Illuminate\Support\Facades\Storage::disk($folder)->delete($image);

    }


    function SortCategoryInSelect($categories,$id=null,$child=FALSE,$parent=false){

        return  \Illuminate\Support\Facades\View::make("general_components.sort_category_in_html")->with([
            "categories" => $categories,
            "id" => $id,
            "child" => $child,
            "parent" => $parent,
        ])->render();

    }




