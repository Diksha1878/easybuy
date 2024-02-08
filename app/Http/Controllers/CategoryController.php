<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        // $query = DB::table('products');
        // if (!empty($request->cat_id)) {
        //     $query->where('id', $request->cat_id);
        // }

        // $products = $query->latest()->paginate(8);

        // if (!empty($request->subcat_id)) {
        //     $query->where('', $request->cat_id);
        // }

        // $products = $query->where('groups.is_active', 1)
        //     ->join('cats', 'cats.id', '=', 'categories.id')
        //     ->select('groups.*', 'categories.slug', 'categories.name as category_name')
        //     ->latest()
        //     ->paginate(8);

        return view('frontend.category');
    }
}
