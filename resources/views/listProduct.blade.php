@extends('layouts.clientv2')
@section('content')
    <div class="breadcrumb-area pt-205 pb-210"
        style="background-image: url(../ezone/assets/img/bg/iphone.jpg)">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 style="color: white;">Category</h2>
                <ul>
                    <li style="color: white;"><a href="{{ env('DOMAIN') }}">home</a></li>
                    @if($breadcrumb != null)
                        <li style="color: black;">{{ $breadcrumb[0]->name }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="shop-page-wrapper ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">Search Products</h3>
                            <div class="sidebar-search">
                                <form action="#">
                                    <input id="search" placeholder="Search Products..." type="text">
                                    <button><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-45">
                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-categories">
                                <ul>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{ env('DOMAIN') }}/category/{{ $category->id }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-widget mb-50">
                            <h3 class="sidebar-title">Top rated products</h3>
                            <div class="sidebar-top-rated-all">
                                @foreach ($topProducts as $product)
                                    <div class="sidebar-top-rated mb-30">
                                        <div class="single-top-rated">
                                            <div class="top-rated-img">
                                                <a href="{{ env('DOMAIN') }}/product/{{ $product->id }}"><img src="<?php echo env('AWS_URL').$product->images ?>" alt="" width="91" height="88"></a>
                                            </div>
                                            <div class="top-rated-text">
                                                <h4><a href="{{ env('DOMAIN') }}/product/{{ $product->id }}">{{ $product->title }}</a></h4>
                                                <div class="top-rated-rating">
                                                    <ul>
                                                        <li><i class="pe-7s-star"></i></li>
                                                        <li><i class="pe-7s-star"></i></li>
                                                        <li><i class="pe-7s-star"></i></li>
                                                        <li><i class="pe-7s-star"></i></li>
                                                        <li><i class="pe-7s-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span>${{ $product->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop-product-wrapper">
                        <div class="shop-bar-area">
                            <div class="shop-bar pb-60">
                                <div class="shop-found-selector">
                                    <div class="shop-found">
                                        <p><span><?php echo count($products)?></span> Product Found</p>
                                    </div>
                                    <div class="shop-selector">
                                        <label>Sort By : </label>
                                        <select name="select" id="sort">
                                            <option value="">Lọc theo giá</option>
                                            <option value="ASC">Tăng dần</option>
                                            <option value="DESC">Giảm dần</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="shop-filter-tab">
                                    <div class="shop-tab nav" role=tablist>
                                        <a class="active" href="#grid-sidebar7" data-toggle="tab" role="tab"
                                            aria-selected="false">
                                            <i class="ti-layout-grid4-alt"></i>
                                        </a>
                                        <a href="#grid-sidebar8" data-toggle="tab" role="tab" aria-selected="true">
                                            <i class="ti-menu"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-product-content tab-content">
                                <div id="grid-sidebar7" class="tab-pane fade active show">
                                    <div class="row" id="content-7">
                                        @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="product-wrapper product-box-style mb-30">
                                                <div class="product-img">
                                                    <a href="{{ env('DOMAIN') }}/product/{{ $product->id }}">
                                                        {{--  <img src="../images/<?php echo explode(",", $product->images)[1] ?>"  --}}
                                                        <img src="<?php echo env('AWS_URL').$product->images ?>"
                                                            alt="">
                                                    </a>
                                                    <span>hot</span>
                                                    <div class="product-action">
                                                        <a class="animate-left" title="Wishlist" href="#">
                                                            <i class="pe-7s-like"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}"><i class="pe-7s-cart"></i></a>
                                                        {{--  <a class="animate-right" title="Quick View" data-toggle="modal"
                                                            data-target="#exampleModal" href="#">
                                                            <i class="pe-7s-look"></i>
                                                        </a>  --}}
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h4><a href="#">{{ $product->title }}</a></h4>
                                                    <span>${{ $product->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="grid-sidebar8" class="tab-pane fade">
                                    <div class="row" id="content-8">
                                        @foreach ($products as $product)
                                        <div class="col-lg-12">
                                            <div
                                                class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
                                                <div class="product-img list-img-width">
                                                    <a href="{{ env('DOMAIN') }}/product/{{ $product->id }}">
                                                        {{--  <img src="../images/<?php echo explode(",", $product->images)[1] ?>"  --}}
                                                        <img src="<?php echo env('AWS_URL').$product->images ?>"
                                                            alt="">
                                                    </a>
                                                    <span>hot</span>
                                                    {{--  <div class="product-action-list-style">
                                                        <a class="animate-right" title="Quick View" data-toggle="modal"
                                                            data-target="#exampleModal" href="#">
                                                            <i class="pe-7s-look"></i>
                                                        </a>
                                                    </div>  --}}
                                                </div>
                                                <div class="product-content-list">
                                                    <div class="product-list-info">
                                                        <h4><a href="#">{{ $product->title }}</a></h4>
                                                        <span>${{ $product->price }}</span>
                                                        <p>{!! $product->short_description !!}</p>
                                                    </div>
                                                    <div class="product-list-cart-wishlist">
                                                        <div class="product-list-cart">
                                                            <a href="javascript:void(0)" class="btn-hover list-btn-style" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}">add to cart</a>
                                                        </div>
                                                        <div class="product-list-wishlist">
                                                            <a class="btn-hover list-btn-wishlist" href="#">
                                                                <i class="pe-7s-like"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($products->hasPages())
                    <div class="pagination-style mt-10 text-center">
                        <ul id="content-paginate">
                            @if($products->currentPage() > 1)
                                <li><a href="{{ $products->previousPageUrl() }}"><i class="ti-angle-left"></i></a></li>
                            @endif
                            @for($i = 1; $i <= $products->lastPage(); $i++)
                                @if($products->currentPage() == $i)
                                    <li class="active"><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                @else
                                    <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor
                            @if ($products->currentPage() < $products->lastPage())
                                <li><a href="{{ $products->nextPageUrl() }}"><i class="ti-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $string = window.location.href;
            $id_cate = $string.substr(-1, $string.length -1);
            $value = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ env('DOMAIN') }}/search",
                data: {
                    'search': $value,
                    'idCate': $id_cate
                },
                success:function(data){
                    url= '{{ URL::to('/search') }}';
                    console.log(url);
                    $('#content-7').html(data[0]);
                    $('#content-8').html(data[1]);
                    $('#content-paginate').html(data[2]);
                }
            });
        })

        $('#sort').on('change', function(){
            $sort = $(this).find(":selected").val();
            $string = window.location.href;
            $id_cate = $string.substr(-1, $string.length -1);
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('/sort') }}',
                data: {
                    'sort': $sort,
                    'idCate': $id_cate
                },
                success:function(data){
                    $('#content-7').html(data[0]);
                    $('#content-8').html(data[1]);
                    $('#content-paginate').html(data[2]);
                }
            });
        });

        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        $(document).on('click', '.animate-top', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');
            var product_price = $(this).data('price');
            var product_name = $(this).data('name');
            var image = $(this).data('image');
 
            var token = "{{ csrf_token() }}";
            var path = "{{ env('DOMAIN') }}/cart/store";
 
            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    product_price: product_price,
                    product_name: product_name,
                    image: image,
                    _token: token,
                },
                success: function(data) {
                     // $("#test").text(data["cartCount"]);
                    location.reload();
                }
            })
        });

        $(document).on('click', '.list-btn-style', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');
            var product_price = $(this).data('price');
            var product_name = $(this).data('name');
            var image = $(this).data('image');
 
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.store') }}";
 
            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    product_qty: product_qty,
                    product_price: product_price,
                    product_name: product_name,
                    image: image,
                    _token: token,
                },
                success: function(data) {
                     // $("#test").text(data["cartCount"]);
                    location.reload();
                }
            })
        })
    </script>
@stop
