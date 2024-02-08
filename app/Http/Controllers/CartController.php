<?php

namespace App\Http\Controllers;

use App\Libs\UserAuth;
use App\Libs\CartUtil;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $data['cartList'] = CartUtil::getCartList();

        // if($data['cartList']->count() === 0){
        //     return back()->with('error', 'Your shopping cart is empty');
        // }
        return view('frontend.cart', $data);
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'p_item_id' => 'required',
                'pid' => 'required',
                'qty' => 'required',
            ]
        );

        if ($validator->fails()) {
            abort(403);
        }

        $cart = CartUtil::addToCart($request->pid, $request->p_item_id, $request->qty);
        if ($cart) {
            $subTotal = 0;
            $totalDelivaryCharge = 0;
            if (CartUtil::getCartList()->count() > 0) {
                foreach (CartUtil::getCartList() as $row) {
                    $productTotal = (float)$row->price * (int)$row->qty;
                    $subTotal += $productTotal;
                    $totalDelivaryCharge += (float)$row->shipping_charge;
                }
            }
            return response()->json(['message' => 'Item added to cart.', 'count' => CartUtil::cartCount(), 'subTotal' => $subTotal, 'totalDelivaryCharge' => $totalDelivaryCharge]);
        } else {
            return response()->json(['message' => 'Something went wrong', 'count' => CartUtil::cartCount()], 400);
        }
    }

    public function deleteCartItem(Request $request)
    {
        // dd($request->all());

        $isDeleted = CartUtil::deleteCartItem($request->item_id);
        if ($isDeleted) {
            $subTotal = 0.00;
            $totalDelivaryCharge = 0.00;
            if (CartUtil::getCartList()->count() > 0) {
                foreach (CartUtil::getCartList() as $row) {
                    $productTotal = (float)$row->price * (int)$row->qty;
                    $subTotal += $productTotal;
                    $totalDelivaryCharge += (float)$row->shipping_charge;
                }
            }
            return response()->json(['message' => 'Item deleted from cart.', 'count' => CartUtil::cartCount(), 'subTotal' => $subTotal, 'totalDelivaryCharge' => $totalDelivaryCharge]);
        } else {
            return response()->json(['message' => 'Something went wrong.', 'count' => CartUtil::cartCount()], 400);
        }
    }
}
