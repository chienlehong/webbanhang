<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function SubCategory()
    {
        $category  = Category::all();
        $subcat = DB::table('subcategories')
            ->join('categories', 'subcategories.category_id', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        return view('admin.category.subcategory', compact('category', 'subcat'));
    }
    public function SubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required'
        ]);
        $subcate = Subcategory::create([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name
        ]);
        if ($subcate) {
            $notification = array(
                'messege' => 'Sub Category Inserted Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function EditSubCategory($id){
        $subcat = DB::table('subcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        return view('admin.category.edit_subcat',compact('subcat','category'));
    }
    public function UpdateSubCategory(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required'
        ]);
        $update = Subcategory::findOrFail($request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name
        ]);
        if($update){
            $notification=array(
                'messege'=>'Sub Category Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('sub.categories')->with($notification); 
        }
    }
    public function DeleteSubCategory($id){
        Subcategory::findOrFail($id)->delete();
        $notification=array(
            'messege'=>'Sub Category Deleted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

}
