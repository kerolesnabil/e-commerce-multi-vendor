<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id','asc') -> paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::treeCrate() ;

        return view('dashboard.categories.create')->with(['categories'=>$categories ]);
    }

    public function store(CategoryRequest $request)
    {
            //validation
        if ($request->has('is_active')) {$request->request->add(['is_active' => 1]);}
        else{$request->request->add(['is_active' => 0]);}

        $request->request->add(['slug' =>Str::slug($request->slug)]);


        if($request -> parent_id == 0) //main category
        {
            $request->request->add([ 'parent_id' => null]);
        }

        if ($request->has('photo')) {
            $fileName = uploadImage('category', $request->photo);
            $request->photo=$fileName;
        }

        //if he choose child category we mus t add parent id

        $category = Category::create($request->except('_token'));

        //save translations
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);

    }

    public function edit($id)
    {

        //get specific categories and its translations

        $category = Category::findOrFail($id);

        if ($category->parent_id==null)
        {
            $category->parent_id=0;
        }

        $categories =Category::treeUpdate($id);

        return view('dashboard.categories.edit')->with(['categories'=>$categories,'category'=>$category]);

    }

    public function update($id, CategoryRequest $request)
    {

        $category = Category::findOrFail($id);

        if($category->parent_id ==$id) //main category
        {
            return redirect()->back()->with('error','parent and category is some');
        }

        if (!$request->has('is_active'))
        {
            $request->request->add(['is_active' => 0]);

        } else {
            $request->request->add(['is_active' => 1]);
        }

        $request->request->add(['slug' =>Str::slug($request->slug)]);

        if($request -> parent_id == 0) //main category
        {
            $request->request->add([ 'parent_id' => null]);
        }

        if ($request->has('photo')) {
            $fileName = uploadImage('category', $request->photo);
            Storage::disk('category')->delete($category->photo);
            $category->img_obj=$fileName;
        }

        $category->update($request->except('_token'));
        //save translations
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);

    }

    public function destroy($id)
    {

            //get specific categories and its translations
            $category = Category::findOrFail($id);

            $category->delete();

            Storage::disk('category')->delete($category->img_obj);

            return redirect()->route('admin.maincategories')->with(['success' => __('admin/general.delete successfully')]);


    }



}
