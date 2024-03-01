<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function category()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }
    public function storecategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $notification = array(
            'messege' => 'Category Added Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    public function Editcategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('category'));
    }
    public function UpdateCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255'
        ]);
        $update = Category::find($request->id)->update([
            'category_name' => $request->category_name
        ]);
        if ($update) {
            $notification = array(
                'messege' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('categories')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return Redirect()->route('categories')->with($notification);
        }
    }
    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $notification = array(
            'messege' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
