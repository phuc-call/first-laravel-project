<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $type_query = false;
        $query = Product::where('status', '=', 1);
        if ($request->category) {
            $listcategoryid = $this->getListCategoryId($request->category);
            $query->whereIn('category_id', $listcategoryid);
            $type_query = true;
        }
        if ($request->brand) {
            $query->where('brand_id', '=', $request->brand);
            $type_query = true;
        }
        if ($request->page) {
            $type_query = true;
        }
        if ($type_query == false) {
            $category_list = Category::where('status', '=', 1)
                ->orderBy('sort_order', 'asc')
                ->get();

            $brand_list = Brand::where('status', '=', 1)
                ->orderBy('sort_order', 'asc')
                ->get();

            $product_list = Product::where('status', '=', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(4);

            return view('frontend.product', compact('category_list', 'brand_list', 'product_list'));
        } else {
            $product_list = $query->orderBy('created_at', 'desc')->paginate(4);
            return view('frontend.product-ajax', compact('product_list'));
        }
    }

    private function getListCategoryId($categoryid)
    {
        $lisid = [];
        array_push($lisid, $categoryid);
        $args1 = [
            ['status', '=', 1],
            ['parent_id', '=', $categoryid]
        ];
        $category_list1 = Category::select('id')->where($args1)->get();
        if (count($category_list1) > 0) {
            foreach ($category_list1 as $item1) {
                array_push($lisid, $item1->id);
                $args2 = [
                    ['status', '=', 1],
                    ['parent_id', '=', $item1->id]
                ];
                $category_list2 = Category::select('id')->where($args2)->get();
                if (count($category_list2) > 0) {
                    foreach ($category_list2 as $item2) {
                        array_push($lisid, $item2->id);
                        $args3 = [
                            ['status', '=', 1],
                            ['parent_id', '=', $item1->id]
                        ];
                        $category_list3 = Category::select('id')->where($args3)->get();
                        if (count($category_list3) > 0) {
                            foreach ($category_list3 as $item3) {
                                array_push($lisid, $item3->id);
                            }
                        }
                    }
                }
            }
        }
        return $lisid;
    }



    function detail($slug)
    {
        $product = Product::select('id', 'name', 'slug', 'thumbnail', 'price_root', 'description', 'category_id', 'brand_id')
            ->where('slug', '=', $slug)
            ->where('status', '=', 1)
            ->first();

        if (!$product) {
            return redirect()->route('site.product');
        }

        return view('frontend.product-detail', compact('product'));
    }
}
