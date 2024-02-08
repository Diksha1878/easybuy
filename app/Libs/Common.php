<?php

namespace App\Libs;

use Illuminate\Support\Facades\DB;

class Common
{
    public static function getCatSlugbById($id)
    {
        $data['categoryList'] = DB::table('cats')->where('status', '1')->where('id', $id)->first();
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['categoryList']->name)));
    }

    public static function getSubcatSlugbById($id)
    {
        $data['subcategoryList'] = DB::table('subcats')->where('status', '1')->where('id', $id)->first();
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['subcategoryList']->name)));
    }

    public static function getSlugName($string)
    {
        return trim(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string))), '-');
    }

    public static function getProductRating($productId)
    {
        $aggregate_rating = 0;
        $data['reviews'] = DB::table('reviews as t1')->select('t2.fname', 't2.profile_img', 't1.text', 't1.title', 't1.rating')->join('users as t2', 't1.user_id', 't2.id')->where('t1.product_id', $productId)->get();
        if ($data['reviews']->count() > 0) {
            $totalRating = 0;
            foreach ($data['reviews'] as $row) {
                $totalRating += (int)$row->rating;
            }
            $aggregate_rating = (int)ceil($totalRating / $data['reviews']->count());
        }
        return $aggregate_rating;
    }

    public static function getCategoryList()
    {
        $catList = DB::table('cats', 't1')->where('t1.status', '1')->orderBy('t1.name', 'asc')->get();
        return $catList;
    }

    public static function getSubCategoryList($catId)
    {
        $catList = DB::table('subcats', 't1')->where('t1.status', '1')->where('t1.cat_id', $catId)->orderBy('t1.name', 'asc')->get();
        return $catList;
    }

    public static function getBrandList()
    {
        if (request()->input('categoryId')) {
            $brandList = DB::table('brands', 't1')->select('t1.name', 't1.id')->where('t1.status', '1')->join('products as t2', 't2.brand_id', '=', 't1.id')->where('t2.cat_id', request()->input('categoryId'))->orderBy('t1.name', 'asc')->groupBy('t1.id')->get();
            return $brandList;
        } else {
            $brandList = DB::table('brands', 't1')->select('t1.name', 't1.id')->where('t1.status', '1')->join('products as t2', 't2.brand_id', '=', 't1.id')->orderBy('t1.name', 'asc')->groupBy('t1.id')->get();
            return $brandList;
        }
    }

    public static function getCategoryMenuList()
    {
        $cats = DB::table('cats')
            ->orderby('name')
            ->get();
        $subcats = DB::table('subcats')
            ->orderby('name')
            ->get();
        $newCats = [];
        foreach ($cats as $cat) {
            $obj['id'] = $cat->id;
            $obj['name'] = $cat->name;
            $obj['status'] = $cat->status;
            $obj['department_id'] = $cat->department_id;
            $obj['image'] = $cat->image;
            $obj['name'] = $cat->name;
            $obj['subcats'] = [];
            $obj['created_at'] = $cat->create_date;
            $obj['updated_at'] = $cat->modify_date;
            foreach ($subcats as $subcat) {
                if ($subcat->cat_id == $cat->id) {
                    $obj1['id'] = $subcat->id;
                    $obj1['name'] = $subcat->name;
                    $obj1['image'] = $subcat->image;
                    $obj1['status'] = $subcat->status;
                    array_push($obj['subcats'], $obj1);
                }
            }
            array_push($newCats, $obj);
        }
        return $newCats;
    }

    public static function paginate($limit, $total, $page_number = NULL, array $config, $callback = null)
    {

        $page_number = (empty(trim($page_number)) || $page_number == NULL) ? 1 : $page_number;
        $total_pages = ceil($total / $limit);
        $config['link_limit'] = (isset($config['link_limit'])) ? $config['link_limit'] : 2;
        $startIndex = ($page_number -  $config['link_limit']);
        $endIndex = ($page_number +  $config['link_limit']);
        $loopLength = $endIndex - $startIndex + 1;

        $link_arr = array();

        if ($callback && $total_pages <= 0) {
            $callback(['error' => 'found no rows']);
        }

        if ($callback && $total_pages < $page_number) {
            $callback(['error' => 'pagination initialized with invalid page number']);
        }

        if ($callback && $total_pages <= 1) {
            $callback(['notice' => 'no page link generated']);
        }

        if (isset($config['link_limit']) && $total_pages > 0 && $total_pages >= $page_number && $total_pages > 1) {

            $link_arr['first'] = 'first';

            $link_arr['prev'] = '<';

            if ($total_pages < $loopLength) {
                $i = 1;
                $endIndex = $total_pages;

                for ($i; $i <= $endIndex; $i++) {

                    $link_arr[$i] = (string) $i;
                }
            } else if ($endIndex > $total_pages) {

                $i = $total_pages - ($config['link_limit'] * 2);
                $endIndex = $total_pages;

                for ($i; $i <= $endIndex; $i++) {

                    $link_arr[$i] = (string) $i;
                }
            } else if ($startIndex > 0) {

                $i = $startIndex;

                for ($i; $i <= $endIndex; $i++) {

                    $link_arr[$i] = (string) $i;
                }
            } else {

                $i = 1;
                $endIndex = ($config['link_limit'] * 2) + 1;

                for ($i; $i <= $endIndex; $i++) {

                    $link_arr[$i] = (string) $i;
                }
            }


            $link_arr['next'] = '>';

            $link_arr['last'] = 'last';
        }

        $data = $link_arr;

        $last_key = $total_pages;
        $el = "";
        $el .= $config['start_tag'];
        foreach ($data as $key => $value) {
            if ($key == $page_number) {
                $el .=  str_replace(['{value}'], [$value], $config['active_link']);
            } else if ($key == 'prev') {
                $el .=  str_replace(['{link}', '{value}'], [((1 >= $page_number) ? $page_number : ($page_number - 1)), $value], $config['link']);
            } else if ($key == 'next') {
                $el .=  str_replace(['{link}', '{value}'], [((!($last_key > $page_number)) ? $page_number : ($page_number + 1)), $value], $config['link']);
            } else if ($key == 'first') {
                $el .=  str_replace(['{link}', '{value}'], [1, 'first'], $config['link']);
            } else if ($key == 'last') {
                $el .=  str_replace(['{link}', '{value}'], [$last_key, 'last'], $config['link']);
            } else {
                $el .=  str_replace(['{link}', '{value}'], [trim($key), $value], $config['link']);
            }
        };
        $el .= $config['end_tag'];
        echo $el;
    }

    public static function getWishlist()
    {
        if (session('user')) {
            return DB::table('wishlists as t1')
                ->select('t1.item_id', 't1.user_id', 't1.created_at', 't1.updated_at', 't3.name', 't3.caption_name', 't3.shipping_charge', 't2.qty as product_qty', 't2.pid', 't2.item_name', 't2.mrp', 't2.combo_price as price', DB::raw('(select thumb from products_images as t4 where t4.p_item_id=t2.id and t4.pid=t2.pid limit 1) as product_image'))
                ->join('products_items as t2', 't1.item_id', 't2.id')
                ->join('products as t3', 't3.id', 't2.pid')
                ->where('t1.user_id', session('user')->id)
                ->get();
        } else {
            return collect([]);
        }
    }

    public static function getAddressbyUser()
    {
        return DB::table('addresses')->where('user_id', session('user')->id)->get();
    }

    public static function getStates()
    {
        return [
            ["id" => 1, "name" => "Andaman and Nicobar Islands"],
            ["id" => 2, "name" =>  "Andhra Pradesh"],
            ["id" => 3, "name" => "Arunachal Pradesh"],
            ["id" => 4, "name" => "Assam"],
            ["id" => 5, "name" => "Bihar"],
            ["id" => 6, "name" => "Chandigarh"],
            ["id" => 7, "name" => "Chhattisgarh"],
            ["id" => 8, "name" => "Dadra and Nagar Haveli"],
            ["id" => 9, "name" => "Daman and Diu"],
            ["id" => 10, "name" => "Delhi"],
            ["id" => 11, "name" => "Goa"],
            ["id" => 12, "name" => "Gujarat"],
            ["id" => 13, "name" => "Haryana"],
            ["id" => 14, "name" => "Himachal Pradesh"],
            ["id" => 15, "name" => "Jammu and Kashmir"],
            ["id" => 16, "name" => "Jharkhand"],
            ["id" => 17, "name" => "Karnataka"],
            ["id" => 18, "name" => "Kerala"],
            ["id" => 19, "name" => "Lakshadweep"],
            ["id" => 20, "name" => "Madhya Pradesh"],
            ["id" => 21, "name" => "Maharashtra"],
            ["id" => 22, "name" => "Manipur"],
            ["id" => 23, "name" => "Meghalaya"],
            ["id" => 24, "name" => "Mizoram"],
            ["id" => 25, "name" => "Nagaland"],
            ["id" => 26, "name" => "Odisha"],
            ["id" => 27, "name" => "Puducherry"],
            ["id" => 28, "name" => "Punjab"],
            ["id" => 29, "name" => "Rajasthan"],
            ["id" => 30, "name" => "Sikkim"],
            ["id" => 31, "name" => "Tamil Nadu"],
            ["id" => 32, "name" => "Telangana"],
            ["id" => 33, "name" => "Tripura"],
            ["id" => 34, "name" => "Uttarakhand"],
            ["id" => 35, "name" => "Uttar Pradesh"],
            ["id" => 36, "name" => "West Bengal"],
        ];
    }

    public static function getCatNameById($id)
    {
        $obj = DB::table('cats')->select('name')->where('id', $id)->first();
        if (!empty($obj)) {
            return $obj->name;
        } else {
            return null;
        }
    }
    public static function getSubCatNameById($id)
    {
        $obj = DB::table('subcats')->select('name')->where('id', $id)->first();
        if (!empty($obj)) {
            return $obj->name;
        } else {
            return null;
        }
    }

    public static function getBrandNameById($id)
    {
        $obj = DB::table('brands')->select('name')->where('id', $id)->first();
        if (!empty($obj)) {
            return $obj->name;
        } else {
            return null;
        }
    }

    public static function getCatImgById($id)
    {
        $obj = DB::table('cats')->select('image')->where('id', $id)->first();
        if (!empty($obj)) {
            return $obj->image;
        } else {
            return null;
        }
    }

    public static function getBrandImgById($id)
    {
        $obj = DB::table('brands')->select('image')->where('id', $id)->first();
        if (!empty($obj)) {
            return $obj->image;
        } else {
            return null;
        }
    }

    public static function getSubCatImgById($id)
    {
        $obj = DB::table('subcats')->select('image')->where('id', $id)->first();
        if (!empty($obj)) {
            return $obj->image;
        } else {
            return null;
        }
    }
    public static function getAddress()
    {
        return  'E-353, Tagore Garden Extension, New Delhi - 110027';
    }
}
