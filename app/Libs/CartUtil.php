<?php

namespace App\Libs;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class CartUtil
{
    public static function addCartDataToDB()
    {
        if (session('user') && session('cart_list') && count((array)session('cart_list'))) {
            foreach (session('cart_list') as $cart) {
                $checkCart = Cart::where('user_id', session('user')->id)->where('item_id', $cart['p_item_id'])->first();

                if ($checkCart) {
                    $obj = Cart::find($checkCart->id);
                    $obj->qty = $cart['qty'];
                    $obj->save();
                } else {
                    $obj = new Cart();
                    $obj->item_id = $cart['p_item_id'];
                    $obj->pid = $cart['pid'];
                    $obj->user_id = session('user')->id;
                    $obj->qty = $cart['qty'];
                    $obj->save();
                }
            }
        }
    }

    public static function addToCart($pid, $p_item_id, $qty)
    {
        $data['p_item_id'] = $p_item_id;
        $data['pid'] = $pid;
        $data['qty'] = $qty;
        $prev = Session::get('cart_list');
        $prev[$p_item_id] = $data;
        Session::put('cart_list', $prev);

        if (UserAuth::has('login')) {

            $checkCart = Cart::where('user_id', session('user')->id)->where('item_id', $p_item_id)->first();

            if ($checkCart) {
                $obj = Cart::find($checkCart->id);
                $obj->qty = $qty;
                $obj->save();
            } else {
                $obj = new Cart();
                $obj->item_id = $p_item_id;
                $obj->pid = $pid;
                $obj->user_id = session('user')->id;
                $obj->qty = $qty;
                $obj->save();
            }
        }

        return true;
    }

    public static function deleteCartItem($itemId)
    {
        $carts = [];
        foreach (session('cart_list') as $row) {
            if ($itemId != $row['p_item_id']) {
                $carts[$row['p_item_id']] = $row;
            }
        }
        session(['cart_list' => $carts]);

        if (UserAuth::has('login')) {
            DB::table('carts')->where('item_id', $itemId)->where('user_id', session('user')->id)->delete();
        }
        return true;
    }

    public static function deleteCart()
    {

        if (session('user')) {
            session()->forget('cart_list');
            DB::table('carts')->where('user_id', session('user')->id)->delete();
        }
    }

    public static function cartCount()
    {
        return count((array)session('cart_list'));
    }

    public static function getCartList()
    {
        $cartList = [];
        // Session::forget('cart_list');
        if (session('user')) {
            $carts = DB::table('carts')->where('user_id', session('user')->id)->get();
            if ($carts->count() > 0) {
                $cart_items = [];
                foreach ($carts as $item) {
                    $cart_items[$item->item_id] =  array('p_item_id' => $item->item_id, 'pid' => $item->pid, 'qty' => $item->qty);
                }

                session(['cart_list' => $cart_items]);
                $cartList  = session('cart_list') ?? [];
            } else {
                $cartList = [];
            }
        } else {
            $cartList = session('cart_list') ?? [];
        }

        $cartList = collect($cartList);
        $obj1 = [];
        if ($cartList->count() > 0) {
            foreach ($cartList as $cart) {
                $single = DB::table('products_items as t1')
                    ->select('t3.token_amt_rate', 't1.id as item_id', 't1.pid', 't1.created_at', 't1.updated_at', 't3.name', 't3.caption_name', 't3.shipping_charge', 't1.item_name', 't1.mrp', 't1.combo_price as price', 't1.qty as aval_qty', DB::raw('(select thumb from products_images as t4 where t4.p_item_id=t1.id and t4.pid=t1.pid limit 1) as product_image'), 't4.name as color_name', 't4.code as color_code', 't5.name as size_name')
                    ->join('products as t3', 't1.pid', 't3.id')
                    ->join('colors as t4', 't1.color', 't4.id')
                    ->join('sizes as t5', 't1.size', 't5.id')
                    ->where('t1.pid', $cart['pid'])
                    ->where('t1.id', $cart['p_item_id'])
                    ->first();
                $single->qty =  $cart['qty'];
                array_push($obj1, $single);
            }
            return collect($obj1);
        }
        // if (Session::has('cart_list')) {
        //     if (UserAuth::has('login')) {
        //         $cart = DB::table('carts')->where('user_id', session('user')->id)->get();
        //         if ($cart->count() > 0) {
        //             foreach ($cart as $item) {
        //                 $data['p_item_id'] = $item->item_id;
        //                 $data['pid'] = $item->pid;
        //                 $data['qty'] = $item->qty;
        //                 $prev = Session::get('cart_list');
        //                 $prev[$item->item_id] = $data;
        //                 Session::put('cart_list', $prev);
        //             }
        //         }
        //         Cart::where('user_id', session('user')->id)->delete();
        //         foreach (Session::get('cart_list') as $row) {
        //             $obj  = new Cart();
        //             $obj->item_id = $row['p_item_id'];
        //             $obj->pid = $row['pid'];
        //             $obj->user_id = session('user')->id;
        //             $obj->qty = $row['qty'];
        //             $obj->save();
        //         }
        //     }
        //     $obj1 = [];
        //     foreach (Session::get('cart_list') as $row) {
        //         $single = DB::table('carts as t1')
        //             ->select('t1.item_id', 't1.pid', 't1.user_id', 't1.qty', 't1.created_at', 't1.updated_at', 't3.name', 't3.shipping_charge', 't2.item_name', 't2.mrp', 't2.combo_price as price', DB::raw('(select thumb from products_images as t4 where t4.p_item_id=t2.id limit 1) as product_image'), 't4.name as color_name', 't4.code as color_code', 't5.name as size_name')
        //             ->join('products_items as t2', 't1.item_id', 't2.id')
        //             ->join('products as t3', 't1.pid', 't3.id')
        //             ->join('colors as t4', 't2.color', 't4.id')
        //             ->join('sizes as t5', 't2.size', 't5.id')
        //             ->where('t1.pid', $row['pid'])->where('t1.item_id', $row['p_item_id'])
        //             ->first();
        //         array_push($obj1, $single);
        //     }
        //     return collect($obj1);
        // }
        // if (!UserAuth::has('login') && Session::has('cart_list')) {
        //     $obj = [];
        //     foreach (Session::get('cart_list') as $row) {
        //         $single = DB::table('products_items as t1')
        //             ->select('t2.name', 't2.shipping_charge', 't1.item_name', 't1.mrp', 't1.combo_price as price', DB::raw('(select thumb from products_images as t4 where t4.p_item_id=t1.id limit 1) as product_image'), 't3.name as color_name', 't3.code as color_code', 't4.name as size_name')
        //             ->join('products as t2', 't1.pid', 't2.id')
        //             ->join('colors as t3', 't1.color', 't3.id')
        //             ->join('sizes as t4', 't1.size', 't4.id')
        //             ->where('t1.pid', $row['pid'])->where('t1.id', $row['p_item_id'])
        //             ->first();
        //         array_push($obj, $single);
        //     }
        //     return collect($obj);
        // }
        // if (UserAuth::has('login') && Session::has('cart_list')) {
        //     $cart = DB::table('carts')->where('user_id', session('user')->id)->get();
        //     if ($cart->count() > 0) {
        //         foreach ($cart as $item) {
        //             $data['p_item_id'] = $item->p_item_id;
        //             $data['pid'] = $item->pid;
        //             $data['qty'] = $item->qty;
        //             $prev = Session::get('cart_list');
        //             $prev[$item->p_item_id] = $data;
        //             Session::put('cart_list', $prev);
        //         }
        //     }
        //     $obj = DB::table('carts as t1')
        //         ->select('t1.item_id', 't1.pid', 't1.user_id', 't1.qty', 't1.created_at', 't1.updated_at', 't3.name', 't3.shipping_charge', 't2.item_name', 't2.mrp', 't2.combo_price as price', DB::raw('(select thumb from products_images as t4 where t4.p_item_id=t2.id limit 1) as product_image'), 't4.name as color_name', 't4.code as color_code', 't5.name as size_name')
        //         ->join('products_items as t2', 't1.item_id', 't2.id')
        //         ->join('products as t3', 't1.pid', 't3.id')
        //         ->join('colors as t4', 't2.color', 't4.id')
        //         ->join('sizes as t5', 't2.size', 't5.id')
        //         ->where('t1.user_id', session('user')->id)
        //         ->get();
        //     return $obj;
        // }
        return collect([]);
    }
}
