<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index($id, $slug)
    {
        $data['productItem'] = DB::table('products_items as t1')->select('t1.*')->where('t1.id', $id)->join('products as t2', 't2.id', '=', 't1.pid')->where('t2.status', '1')->first();
        if (empty($data['productItem'])) {
            abort(404);
        }
        $data['wishList'] = DB::table('wishlists')->where('user_id', session('user')->id ?? 0)->where('item_id', $data['productItem']->id)->first();
        // dd($data['productItem']);
        // DB::enableQueryLog();
        $data['product'] = DB::table('products  as t1')
            ->select('t1.*', 't2.name as cat_name', 't3.name as sub_cat_name')
            ->join('cats as t2', 't2.id', 't1.cat_id')
            ->leftJoin('subcats as t3', 't3.id', 't1.sub_cat_id')
            ->where('t1.id', $data['productItem']->pid)->first();
        // dd(DB::getQueryLog());
        $data['productItems'] = DB::table('products_items')->where('pid', $data['product']->id)->latest()->get();
        $data['productImages'] = DB::table('products_images')->where('pid', $data['product']->id)->where('p_item_id', $data['productItem']->id)->get();
        $data['productSpecs'] = DB::table('product_specifications')->where('pid', $data['product']->id)->get();
        $data['pColor'] = DB::table('colors')->where('id', $data['productItem']->color)->first();
        $data['pSize'] = DB::table('sizes')->where('id', $data['productItem']->size)->first();
        $data['productColors'] = DB::table('products_items as t1')
            ->select('t1.pid', 't1.id as p_item_id', 't2.name', 't2.code', 't2.id')
            ->join('colors as t2', 't1.color', 't2.id')
            ->where('t1.pid', $data['product']->id)
            ->where('t2.name', '!=', 'none')
            ->groupBy('t2.code')->get();

        $data['productSizes'] = DB::table('products_items as t1')
            ->select('t1.pid', 't1.id as p_item_id', 't2.name', 't2.id')
            ->join('sizes as t2', 't1.size', 't2.id')
            ->where('t1.pid', $data['product']->id)
            ->where('t2.name', '!=', 'none')
            ->groupBy('t2.name')->orderby('t2.id')->get();

        // DB::enableQueryLog();
        $data['similarProducts'] = DB::table('products', 't1')
            ->select(DB::raw('(select id from wishlists as t6 where t6.user_id=' . (session('user')->id ?? 0) . ' and t6.item_id=t2.id) as wishlist_id'), 't1.id', 't1.name', 't1.caption_name', 't1.short_desp', 't1.long_desp', 't1.product_tag', DB::raw('3 as rating'), 't2.mrp', 't2.combo_price', 't2.qty', 't2.id as item_id', 't2.color', 't2.size', 't2.sku', 't3.thumb', 't3.banner', 't3.zoom')
            ->join('products_items as t2', 't2.pid', '=', 't1.id')
            ->join('products_images as t3', function ($join) {
                $join->on(DB::raw('(t3.p_item_id=t2.id and t3.pid=t2.pid)'), DB::raw('1'));
            })
            ->join('similar_products as t5', 't5.similar_product_id', '=', 't1.id')
            ->where('t5.product_id', '=', $data['productItem']->pid)
            ->where('t1.id', '!=', $data['productItem']->pid)
            ->latest('t1.created_at')->groupBy('t1.id', 't1.name', 't1.product_tag')->limit(4)->inRandomOrder()->get();

        // dd(DB::getQueryLog());

        $data['reviews'] = DB::table('reviews as t1')->select('t2.fname', 't2.profile_img', 't1.text', 't1.title', 't1.rating')->join('users as t2', 't1.user_id', 't2.id')->where('t1.product_id', $data['product']->id)->get();
        if ($data['reviews']->count() > 0) {
            $totalRating = 0;
            foreach ($data['reviews'] as $row) {
                $totalRating += (int)$row->rating;
            }
            $data['aggregate_rating'] = (int)ceil($totalRating / $data['reviews']->count());
        }
        return view('frontend.product', $data);
    }

    public function productList(Request $request)
    {
        // DB::enableQueryLog();
        $query = DB::table('products', 't1');
        if (!empty($request->categoryId)) {
            // dd('category');
            $query->where('t1.cat_id', $request->categoryId);
        }
        if (!empty($request->subCategoryId)) {
            $query->where('t1.sub_cat_id', $request->subCategoryId);
        }
        if (!empty($request->brandId)) {
            // dd('brand');
            $query->where('t1.brand_id', $request->brandId);
        }

        if (!empty($request->minPrice) && !empty($request->maxPrice)) {
            $query->whereBetween('t2.combo_price', [$request->minPrice, $request->maxPrice]);
        } else if (!empty($request->maxPrice) && empty($request->minPrice)) {
            $query->whereBetween('t2.combo_price', [0, $request->maxPrice]);
        } else if (!empty($request->minPrice) && empty($request->maxPrice)) {
            $query->whereBetween('t2.combo_price', [$request->minPrice, 500000]);
        }

        if (!empty($request->search)) {
            $query->where(function ($query) use ($request) {
                $key_segments = explode(' ', $request->search);
                // dd($key_segments);
                if (count((array)$key_segments) > 0) {
                    foreach ($key_segments as $k => $sKey) {
                        if ($k === 0) {
                            $query->where('t1.name', 'like', '%' . $sKey . '%');
                        } else {
                            $query->where('t1.name', 'like', '% ' . $sKey . '%');
                        }

                        // ->where('t2.item_name', 'like',  $sKey . '%')
                        // ->where('t1.name', 'like', '% '. $sKey . '%');
                        // ->where('t2.item_name', 'like', '% '. $sKey . '%');
                    }
                }
            });
        }

        if ($request->filter == 1) {
        } else if ($request->filter == 2) {
            $query->orderBy('t1.name', 'ASC');
        } else if ($request->filter == 3) {
            $query->orderBy('t1.name', 'DESC');
        } else if ($request->filter == 4) {
            $query->orderBy('t2.combo_price', 'ASC');
        } else if ($request->filter == 5) {
            $query->orderBy('t2.combo_price', 'DESC');
        }

        if ($request->topProducts == 1) {
            $query->join('top_products as t4', 't4.product_id', '=', 't1.id');
        } else if ($request->arrivalProduct == 1) {
            $query->join('arrivals as t4', 't4.product_id', '=', 't1.id');
        }

        $products = $query
            ->select(DB::raw('(select id from wishlists as t6 where t6.user_id=' . (session('user')->id ?? 0) . ' and t6.item_id=t2.id) as wishlist_id'), 't1.id', 't1.name', 't1.caption_name', 't1.short_desp', 't1.long_desp', 't1.product_tag', DB::raw('3 as rating'), 't2.mrp', 't2.combo_price', 't2.qty', 't2.id as item_id', 't2.color', 't2.size', 't2.sku', 't3.thumb', 't3.banner', 't3.zoom')
            ->where('t1.status', '1')
            ->join('products_items as t2', 't2.pid', '=', 't1.id')
            ->join('products_images as t3', function ($join) {
                $join->on(DB::raw('(t3.p_item_id=t2.id and t3.pid=t2.pid)'), DB::raw('1'));
            })
            ->latest('t1.created_at')->groupBy('t1.id', 't1.name', 't1.product_tag')->paginate(8);


        // dd(DB::getQueryLog());

        return view('frontend.products', ['products' => $products]);
    }

    public function storeReview(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'star' => 'required',
                'title' => 'required',
                'review' => 'required',
            ],
            [
                'star.required' => 'Please select rating.',
                'title.required' => 'Please enter title.',
                'review.required' => 'Please write review.',
            ]
        );

        if ($validator->fails()) {
            $errors = $this->error_processor($validator);
            return response()->json(['form_errors' => $errors, 'form_data' => $request->all()], 400);
        }
        $obj = new Review();
        $obj->user_id = session('user')->id;
        $obj->title = $request->title;
        $obj->text = $request->review;
        $obj->rating = $request->star;
        $obj->product_id = $request->pid;
        $obj->item_id = $request->p_item_id;
        $obj->save();

        $user = User::find(session('user')->id);

        $form_data = [
            'fname' => $user->fname,
            'profile_img' => $user->profile_img,
            'text' => $request->review,
            'title' => $request->title,
            'rating' => $request->star,
        ];

        return response()->json(['message' => 'Review added successfully', 'form_data' => $form_data]);
    }
}
