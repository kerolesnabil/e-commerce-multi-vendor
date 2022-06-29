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

    function SortCategoryInSelect($categories,$id=false,$child=FALSE,$parent=false){
        $str='';
        if(count($categories)){
            foreach ($categories as $item){
                $str.="<option value=".$item->id.". class='text-success' >" .$item->name .(($child==true)?'-'.$parent:'') ."</option>";
                //DO we have any children?
                if (isset($item->children)&& count($item->children)){
                    $str.=SortCategoryInSelect($item->children,false,true,$item->name);
                }
            }
        }

        return $str;
    }




