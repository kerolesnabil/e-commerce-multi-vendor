<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::with('_parent')->orderBy('id','asc') -> paginate(PAGINATION_COUNT);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::select('id','parent_id')->parent()->with(['children'])->orderby('parent_id')->get() ;

        return view('dashboard.categories.create')->with(['categories'=>$categories ]);
    }

    public function store(MainCategoryRequest $request)
    {
            //validation
        if ($request->has('is_active')) {$request->request->add(['is_active' => 1]);}
        else{$request->request->add(['is_active' => 0]);}

        $request->request->add(['slug' =>Str::slug($request->slug)]);


        if($request -> type == CategoryType::mainCategory) //main category
        {
            $request->request->add(['parent_id' => null]);
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