<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libs\Common;

class FrontendController extends Controller
{
    public function index()
    {
        $data['categoryList'] = DB::table('cats')->where('status', '1')->orderBy('name')->get();
        $data['sliders'] = DB::table('offers')->where('status', '1')->get();
        $data['brands'] = DB::table('brands')->where('status', '1')->get();
        // $data['top_products'] = DB::table('products', 't1')
        //     ->select(DB::raw('(select id from wishlists as t6 where t6.user_id=' . (session('user')->id ?? 0) . ' and t6.item_id=t2.id) as wishlist_id'), 't1.id', 't1.name', 't1.caption_name', 't1.short_desp', 't1.long_desp', 't1.product_tag', DB::raw('3 as rating'), 't2.mrp', 't2.combo_price', 't2.qty', 't2.id as item_id', 't2.color', 't2.size', 't2.sku', 't3.thumb', 't3.banner', 't3.zoom')
        //     ->join('products_items as t2', 't2.pid', '=', 't1.id')
        //     ->join('top_products as t4', 't4.product_id', '=', 't1.id')
        //     ->join('products_images as t3', function ($join) {
        //         $join->on(DB::raw('(t3.p_item_id=t2.id and t3.pid=t2.pid)'), DB::raw('1'));
        //     })
        //     ->latest('t1.created_at')->groupBy('t1.id', 't1.name', 't1.product_tag')->limit(4)->inRandomOrder()->get();

        // $data['arrival_products'] = DB::table('products', 't1')
        //     ->select(DB::raw('(select id from wishlists as t6 where t6.user_id=' . (session('user')->id ?? 0) . ' and t6.item_id=t2.id) as wishlist_id'), 't1.id', 't1.name', 't1.caption_name', 't1.short_desp', 't1.long_desp', 't1.product_tag', DB::raw('3 as rating'), 't2.mrp', 't2.combo_price', 't2.qty', 't2.id as item_id', 't2.color', 't2.size', 't2.sku', 't3.thumb', 't3.banner', 't3.zoom')
        //     ->join('products_items as t2', 't2.pid', '=', 't1.id')
        //     ->join('arrivals as t4', 't4.product_id', '=', 't1.id')
        //     ->join('products_images as t3', function ($join) {
        //         $join->on(DB::raw('(t3.p_item_id=t2.id and t3.pid=t2.pid)'), DB::raw('1'));
        //     })
        //     ->latest('t1.created_at')->groupBy('t1.id', 't1.name', 't1.product_tag')->limit(4)->inRandomOrder()->get();

        return view('frontend.home', $data);
    }

    public function sitemap()
    {
        $date = date("2022-10-02 18:03:16");
        header('Cache-control: max-age=' . (60 * 60 * 24 * 365));
        header('Expires: ' . gmdate(DATE_RFC1123, time() + 60 * 60 * 24 * 365));
        header('Content-Type: text/xml');
        ob_start();
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
        ';

        echo '
            <url>
            <loc>'.env('APP_URL').'</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
            <url>
            <loc>'.env('APP_URL').'/signup</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
            <url>
            <loc>'.env('APP_URL').'/login</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
            <url>
            <loc>'.env('APP_URL').'/about-us</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
            <url>
            <loc>'.env('APP_URL').'/contact-us</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
            <url>
            <loc>'.env('APP_URL').'/privacy-policy</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
            <url>
            <loc>'.env('APP_URL').'/terms-and-condition</loc>
            <lastmod>' . date("c", strtotime($date)) . '</lastmod>
            </url>
        ';
        
        $categories = DB::table('cats')
        ->select('name','id','updated_at')
        ->where('status', '1')
        ->orderBy('name', 'ASC')
        ->get();
        
        if($categories->count() > 0){
            foreach( $categories as $category){
                echo '
                <url>
                <loc>'.env('APP_URL').'/products/'.Common::getSlugName($category->name).'?categoryId='.$category->id.'</loc>
                <lastmod>' . date("c", strtotime($category->updated_at)) . '</lastmod>
                </url>
                ';  
            }
        }

        $subCategories = DB::table('subcats')
        ->select('name','cat_name','id','cat_id','updated_at')
        ->where('status', '1')
        ->orderBy('name', 'ASC')
        ->get();

        if($subCategories->count() > 0){
            foreach( $subCategories as $subCategory){
                echo '
                <url>
                <loc>'.env('APP_URL').'/products/'.Common::getSlugName($subCategory->cat_name).'/'.Common::getSlugName($subCategory->name).'?categoryId='.$subCategory->cat_id.'&subCategoryId='.$subCategory->id.'</loc>
                <lastmod>' . date("c", strtotime($subCategory->updated_at)) . '</lastmod>
                </url>
                ';  
            }
        }

        $brands = DB::table('brands')
        ->select('name','id','updated_at')
        ->where('status', '1')
        ->orderBy('name', 'ASC')
        ->get();

        if($brands->count() > 0){
            foreach( $brands as $brand){
                echo '
                <url>
                <loc>'.env('APP_URL').'/products/'.Common::getSlugName($brand->name).'?brandId='.$brand->id.'</loc>
                <lastmod>' . date("c", strtotime($brand->updated_at)) . '</lastmod>
                </url>
                ';  
            }
        }

        $products = DB::table('products', 't1')
        ->select('t1.name','t1.id','t1.updated_at', 't2.id as item_id')
        ->leftJoin('products_items as t2', 't1.id', 't2.pid')
        ->where('t1.status', '1')
        ->groupBy('t1.id')
        ->orderBy('t1.name', 'ASC')
        ->get();

        if($products->count() > 0){
            foreach($products as $product){
                echo '
                <url>
                <loc>'.env('APP_URL').'/product/'.$product->item_id.'/'.Common::getSlugName($product->name).'</loc>
                <lastmod>' . date("c", strtotime($product->updated_at)) . '</lastmod>
                </url>
                ';  
            }
        }

        echo '</urlset>';
        $data = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', ob_get_clean());
        echo ($data);
    }

    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }

    public function brandList(Request $request)
    {
        // dd($request->all());
        // DB::enableQueryLog();
        if (empty($request->categoryId) || empty($request->subCategoryId)) {
            abort(404);
        }
        $query = DB::table('brands', 't1');
        if (!empty($request->categoryId)) {
            $query->where('t2.cat_id', $request->categoryId);
        }
        if (!empty($request->subCategoryId)) {
            $query->where('t2.sub_cat_id', $request->subCategoryId);
        }

        // $products = $query
        //     ->select(DB::raw('(select id from wishlists as t6 where t6.user_id=' . (session('user')->id ?? 0) . ' and t6.item_id=t2.id) as wishlist_id'), 't1.id', 't1.name', 't1.caption_name', 't1.short_desp', 't1.long_desp', 't1.product_tag', DB::raw('3 as rating'), 't2.mrp', 't2.combo_price', 't2.qty', 't2.id as item_id', 't2.color', 't2.size', 't2.sku', 't3.thumb', 't3.banner', 't3.zoom')
        //     ->where('t1.status', '1')
        //     ->join('products_items as t2', 't2.pid', '=', 't1.id')
        //     ->join('products_images as t3', function ($join) {
        //         $join->on(DB::raw('(t3.p_item_id=t2.id and t3.pid=t2.pid)'), DB::raw('1'));
        //     })
        //     ->latest('t1.created_at')->groupBy('t1.id', 't1.name', 't1.product_tag')->paginate(8);

        $brands = $query->select('t1.name', 't1.image', 't1.id','t2.cat_id','t2.sub_cat_id')
            ->join('products as t2', 't2.brand_id', '=', 't1.id')
            ->orderBy('t1.name', 'asc')->groupBy('t1.id')
            ->get();
        // dd(DB::getQueryLog());

        return view('frontend.brands', ['brands' => $brands]);
    }
}
