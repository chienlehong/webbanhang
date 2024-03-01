<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function StoreNewslater(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:newslaters|max:55',
               ]);
       
          $data = array();
          $data['email'] = $request->email;
          $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');
          DB::table('newslaters')->insert($data);
          $notification=array(
                   'messege'=>'Thanks for Subscribing',
                   'alert-type'=>'success'
                    );
                  return Redirect()->back()->with($notification); 	
    }
    public function OrderTraking(Request $request){
        $code = $request->status_code;
        $track = DB::table('orders')->where('status_code' , $code)->first();
        if($track){
            return view('pages.tracking',compact('track'));
        }else{
            $notification=array(
                'messege'=>'Status Code Invalid',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
    
        }
    }
}
