<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::parent()->orderBy('id','asc') -> paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories =   Category::select('id','parent_id')->get();
        return view('dashboard.categories.create',compact('categories'));
    }

    public function store(MainCategoryRequest $request)
    {
            //validation
            if ($request->has('is_active')) {$request->request->add(['is_active' => 1]);}
            else{$request->request->add(['is_active' => 0]);}

            $request->request->add(['slug' =>Str::slug($request->slug)]);

            $category = Category::create([
                'slug'=>$request->slug,
                'parent_id'=>0,
                'is_active'=>$request->is_active
            ]);

            //save translations
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم ألاضافة بنجاح']);

    }

    public function edit($id)
    {

        //get specific categories and its translations

        $category = Category::orderBy('id', 'DESC')->find($id);

        if (!$category) {
            return redirect()->route('admin.maincategories')->with(['error' => __('admin/general.category not found')]);
        }


        return view('dashboard.categories.edit', compact('category'));

    }

    public function update($id, MainCategoryRequest $request)
    {
        try {
            //validation

            //update DB

            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('admin.maincategories')->with(['error' => __('admin/.general.category not found')]);
            }
            if (!$request->has('is_active'))
            {
                $request->request->add(['is_active' => 0]);

            } else {
                $request->request->add(['is_active' => 1]);

            }

            $request->request->add(['slug' =>Str::slug($request->slug)]);

            $category->update($request->all());
            //save translations
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.maincategories')->with(['success' => __('admin/general.updated successfully')]);
        } catch (\Exception $ex) {

            return redirect()->route('admin.maincategories')->with(['error' => __('admin/general.error to update')]);
        }

    }

    public function destroy($id)
    {

        try {
            //get specific categories and its translations
            $category = Category::findOrFail($id);

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => __('admin/general.delete successfully')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' =>  __('admin/general.error to delete')]);
        }
    }



}
