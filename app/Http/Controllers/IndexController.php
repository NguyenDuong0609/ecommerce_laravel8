<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use DB;

class IndexController extends Controller
{
    public function index() {
        $topProducts = Product::where('product_type_id', 1)->with('category')->get();
        $sellerProducts = Product::where('product_type_id', 2)->limit(6)->with('category')->get();
        $newProducts = Product::where('product_type_id', 3)->with('category')->get();

        return view('index', ['topProducts' => $topProducts, 'sellerProducts' => $sellerProducts, 'newProducts' => $newProducts]);
    }

    public function productCategory($category_id)
    {
        $categories = $this->categories;
        $products = Product::where('category_id', $category_id)->with('category')->paginate(4);
        $topProducts = Product::orderBy('created_at', 'DESC')->with('category')->limit(4)->get();
        $breadcrumb = Category::select('id', 'name')->where('id', $category_id)->get();
        return view('listProduct',['products' => $products, 'topProducts' => $topProducts, 'breadcrumb' => $breadcrumb, 'categories' => $categories]);
    }

    public function productDetail($product_id) {
        $productDetail = Product::where('id', $product_id)->with('category')->get();
        $productRelated = Product::where('category_id', $productDetail[0]->category_id)->where('id', '!=', $product_id)->get();
        $breadcrumb = ['category' => $productDetail[0]->category->name, 'product' => $productDetail[0]->title];

        return view('productDetails', ['productDetail' => $productDetail, 'breadcrumb' => $breadcrumb, 'productRelated' => $productRelated]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output_7 = '';
            $output_8 = '';
            $out_paginate = '';
            $products = Product::where('category_id', $request->idCate)->where('title', 'LIKE', '%' . $request->search . '%')->with('category')->paginate(4);

            if ($products) {
                foreach ($products as $key => $product) {
                    $output_7 .= '<div class="col-lg-4 col-md-6">
                        <div class="product-wrapper product-box-style mb-30">
                            <div class="product-img">
                                <a href="/product/'. $product->id .'">
                                    <img src="'.env('AWS_URL').$product->images .'" alt="">
                                </a>
                                <span>hot</span>
                                <div class="product-action">
                                    <a class="animate-left" title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                    <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="'. $product->id .'" data-price="'. $product->price .'" data-name="'. $product->title .'"><i class="pe-7s-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="#">'. $product->title .'</a></h4>
                                <span>$'. $product->price .'</span>
                            </div>
                        </div>
                    </div>';

                    $output_8 .= '
                        <div class="col-lg-12">
                            <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                <div class="product-img list-img-width">
                                    <a href="/product/'. $product->id .'">
                                        <img src="'.env('AWS_URL').$product->images .'" alt="">
                                    </a>
                                    <span>hot</span>
                                </div>
                                <div class="product-content-list">
                                    <div class="product-list-info">
                                        <h4><a href="#">'. $product->title .'</a></h4>
                                        <span>$'.$product->price .'</span>
                                        <p>'. $product->short_description .'</p>
                                    </div>
                                    <div class="product-list-cart-wishlist">
                                        <div class="product-list-cart">
                                        <a href="javascript:void(0)" class="btn-hover list-btn-style" data-quantity="1" data-product-id="'. $product->id .'" data-price="'. $product->price .'" data-name="'. $product->title .'">add to cart</a>
                                        </div>
                                        <div class="product-list-wishlist">
                                            <a class="btn-hover list-btn-wishlist" href="#"><i class="pe-7s-like"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
                if ($products->currentPage() > 1) {
                    $out_paginate .= '<li><a href="'. $products->previousPageUrl() .'"><i class="ti-angle-left"></i></a></li>';
                }
                for($i = 1; $i <= $products->lastPage(); $i++) 
                    {
                        if($products->currentPage() == $i)
                            $out_paginate .= '<li class="active"><a href="'. $products->url($i) .'">'. $i .'</a></li>';
                        else
                            $out_paginate .= '<li><a href="'. $products->url($i) .'&idCate='. $request->idCate .'&search='. $request->search .'">'. $i .'</a></li>';
                    }
                if ($products->currentPage() < $products->lastPage()) {
                    $out_paginate .= '<li><a href="'. $products->nextPageUrl() .'"><i class="ti-angle-right"></i></a></li>';
                }
            }
            return Response([$output_7, $output_8, $out_paginate]);
        } else {
            $categories = $this->categories;
            $topProducts = Product::orderBy('created_at', 'DESC')->with('category')->limit(4)->get();
            if($request->idCate) {
                $products = Product::where('category_id', $request->idCate)->where('title', 'LIKE', '%' . $request->search . '%')->with('category')->paginate(4);
                $breadcrumb = Category::select('id', 'name')->where('id', $request->idCate)->get();
                $products->appends(['search' => $request->search, 'idCate' => $request->idCate])->links();
            } else {
                $products = Product::where('title', 'LIKE', '%' . $request->search . '%')->with('category')->paginate(4);
                $breadcrumb = null;
                $products->appends(['search' => $request->search])->links();
            }
            
            return view('listProduct',['products' => $products, 'topProducts' => $topProducts, 'breadcrumb' => $breadcrumb, 'categories' => $categories]);
        }
    }

    public function sort(Request $request)
    {
        if ($request->ajax()) {
            $output_7 = '';
            $output_8 = '';
            $out_paginate = '';
            $products = Product::where('category_id', $request->idCate)->orderBy('price', $request->sort)->with('category')->paginate(4);

            if ($products) {
                foreach ($products as $key => $product) {
                    $output_7 .= '<div class="col-lg-4 col-md-6">
                        <div class="product-wrapper product-box-style mb-30">
                            <div class="product-img">
                                <a href="/product/'. $product->id .'">
                                    <img src="'.env('AWS_URL').$product->images .'" alt="">
                                </a>
                                <span>hot</span>
                                <div class="product-action">
                                    <a class="animate-left" title="Wishlist" href="#"><i class="pe-7s-like"></i></a>
                                    <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="'. $product->id .'" data-price="'. $product->price .'" data-name="'. $product->title .'"><i class="pe-7s-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="#">'. $product->title .'</a></h4>
                                <span>$'. $product->price .'</span>
                            </div>
                        </div>
                    </div>';

                    $output_8 .= '
                        <div class="col-lg-12">
                            <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                <div class="product-img list-img-width">
                                    <a href="/product/'. $product->id .'">
                                        <img src="'.env('AWS_URL').$product->images .'" alt="">
                                    </a>
                                    <span>hot</span>
                                </div>
                                <div class="product-content-list">
                                    <div class="product-list-info">
                                        <h4><a href="#">'. $product->title .'</a></h4>
                                        <span>$'.$product->price .'</span>
                                        <p>'. $product->short_description .'</p>
                                    </div>
                                    <div class="product-list-cart-wishlist">
                                        <div class="product-list-cart">
                                            <a href="javascript:void(0)" class="btn-hover list-btn-style" data-quantity="1" data-product-id="'. $product->id .'" data-price="'. $product->price .'" data-name="'. $product->title .'">add to cart</a>
                                        </div>
                                        <div class="product-list-wishlist">
                                            <a class="btn-hover list-btn-wishlist" href="#"><i class="pe-7s-like"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }

                if ($products->currentPage() > 1) {
                    $out_paginate .= '<li><a href="'. $products->previousPageUrl() .'"><i class="ti-angle-left"></i></a></li>';
                }
                for($i = 1; $i <= $products->lastPage(); $i++) 
                    {
                        if($products->currentPage() == $i)
                            $out_paginate .= '<li class="active"><a href="'. $products->url($i) .'">'. $i .'</a></li>';
                        else
                        $out_paginate .= '<li><a href="'. $products->url($i) .'&idCate='. $request->idCate .'&sort='. $request->sort .'">'. $i .'</a></li>';
                    }
                if ($products->currentPage() < $products->lastPage()) {
                    $out_paginate .= '<li><a href="'. $products->nextPageUrl() .'"><i class="ti-angle-right"></i></a></li>';
                }
            }
            return Response([$output_7, $output_8, $out_paginate]);
        } else {
            $categories = $this->categories;
            $products = Product::where('category_id', $request->idCate)->orderBy('price', $request->sort)->with('category')->paginate(4);
            $topProducts = Product::orderBy('created_at', 'DESC')->with('category')->limit(4)->get();
            $breadcrumb = Category::select('id', 'name')->where('id', $request->idCate)->get();
            $products->appends(['sort' => $request->sort, 'idCate' => $request->idCate])->links();
            return view('listProduct',['products' => $products, 'topProducts' => $topProducts, 'breadcrumb' => $breadcrumb, 'categories' => $categories]);
        }
    }
}
