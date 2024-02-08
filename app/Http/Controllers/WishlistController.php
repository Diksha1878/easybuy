<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Libs\Common;
use App\Libs\UserAuth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index()
    {
        return view('frontend.user.wishlist');
    }
    //ajax call
    public function addToWishlist(Request $request)
    {
        if (UserAuth::has('login') === false) {
            return response()->json(['message' => 'Please login first', 'added' => false, 'count' => Common::getWishlist()->count()], 401);
        }
        $checkWishlist = Wishlist::select('id')->where('user_id', session('user')->id)->where('item_id', $request->id)->first();

        if ($checkWishlist) {
            $whishlist = Wishlist::find($checkWishlist->id);
            $whishlist->delete();
            return response()->json(['message' => 'Item removed from wishlist', 'added' => false, 'count' => Common::getWishlist()->count()]);
        } else {

            $whishlist = new Wishlist();
            $whishlist->user_id = session('user')->id;
            $whishlist->item_id = $request->id;
            $whishlist->save();

            return response()->json(['message' => 'Item added into wishlist', 'added' => true, 'count' => Common::getWishlist()->count()]);
        }
    }
}
