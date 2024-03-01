<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function addWishlist($id){
        $user_id = Auth::id();
        $check = DB::table('wishlists')->where('user_id' , $user_id)->where('product_id' , $id)->first();
        $data = array(
           'user_id'=> $user_id,
           'product_id' => $id,
           'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        );
        if(Auth::check()){
            if($check){
                return response()->json(['error' => 'Product Already Has no your wishlist']);
            }else{
                DB::table('wishlists')->insert($data);
                return response()->json(['success' => 'Product Added on wishlist']);
            }
        }else{
           return response()->json(['error' => 'At first loing your account']);
        }

    }
}
