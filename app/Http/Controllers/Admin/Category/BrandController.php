<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function Brand()
    {
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
    }
    public function StoreBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands|max:55'
        ]);
        if ($request->file('brand_logo')) {
            $file = $request->file('brand_logo');
            $fileName  = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save('media/brand/' . $fileName);
            $save_url = 'media/brand/' . $fileName;
            Brand::create([
                'brand_name' => $request->brand_name,
                'brand_logo' => $save_url,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
            $notification = array(
                'messege' => 'Brand Inserted Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            Brand::create([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
            $notification = array(
                'messege' => 'Its Done',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    public function EditBrand($id)
    {
        $brand = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.edit_brand', compact('brand'));
    }
    public function UpdateBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:55'
        ]);
        $brand_id = $request->id;
        $old_logo = $request->old_logo;
        if($request->file('brand_logo')){
            unlink($old_logo);
            $file = $request->file('brand_logo');
            $fileName  = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save('media/brand/' . $fileName);
            $save_url = 'media/brand/' . $fileName;
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_logo' => $save_url,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')  
            ]);
            $notification=array(
                'messege'=>'Brand Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('admin.brand')->with($notification);
        }else{
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh')  
            ]);
            $notification=array(
                'messege'=>'Update Without Images',
                'alert-type'=>'success'
                 );
               return Redirect()->route('admin.brand')->with($notification);
        }
    }
    public function DeleteBrand($id)
    {
        $brand_image_old = Brand::find($id)->brand_logo;

        unlink($brand_image_old);
        Brand::findOrFail($id)->delete();
        $notification = array(
            'messege' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
