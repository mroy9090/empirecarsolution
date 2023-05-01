<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    //
    function category()
    {
        $category_data = Category::where('user_id', Auth::id())->get();
        $soft_delete  = Category::where('user_id', Auth::id())->onlyTrashed()->get();

        return view('category.index',compact('category_data', 'soft_delete'));
    }
    function insertCategory(Request $request){
        // print_r(Auth::id());
        $request->validate([
            'category_name' => 'required | min:2 | max:20 | unique:categories,category_name'
        ], [
            'category_name.required' => 'Category name should be filled in'
        ]);
        Category::insert([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ]);
        return back()->with('category_insert_status', 'Category name ' . $request->category_name . ' added successfully');
    }
    function categoryDelete($category_id)
    {
        if (Category::where('id', $category_id)->exists()) {
            Category::where('id', $category_id)->delete();
        }

        $db_query = Category::select('category_name')->where('id', $category_id);
        return back()->with('category_delete', $db_query);
    }
    function categoryRestore($category_id)
    {
        Category::withTrashed()->where('id', $category_id)->restore();
        return back();
    }
    function categoryForceDelete($category_id)
    {
        Category::withTrashed()->where('id', $category_id)->forceDelete();
        return back();
    }


}
