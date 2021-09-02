<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class IndexController extends Controller
{
    public function index() {
        $topProducts = Product::where('product_type_id', 1)->with('category')->get();
        $sellerProducts = Product::where('product_type_id', 2)->with('category')->get();
        $newProducts = Product::where('product_type_id', 4)->with('category')->get();
        return view('index', ['topProducts' => $topProducts, 'sellerProducts' => $sellerProducts, 'newProducts' => $newProducts]);
    }

    public function productCategory($category_id)
    {
        $categories = $this->categories;
        $products = Product::where('category_id', $category_id)->with('category')->paginate(4);
        $breadcrumb = Category::select('id', 'name')->where('id', $category_id)->get();

        return view('listProduct',['products' => $products, 'breadcrumb' => $breadcrumb, 'categories' => $categories]);
    }

    public function productDetail($product_id) {
        $productDetail = Product::where('id', $product_id)->with('category')->get();
        $productRelated = Product::where('category_id', $productDetail[0]->category_id)->where('id', '!=', $product_id)->get();
        $breadcrumb = ['category' => $productDetail[0]->category->name, 'product' => $productDetail[0]->title];
        // return [$productDetail, $productRelated, $breadcrumb];

        return view('productDetails', ['productDetail' => $productDetail, 'breadcrumb' => $breadcrumb, 'productRelated' => $productRelated]);
    }
}
