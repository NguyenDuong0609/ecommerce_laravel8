@extends('layouts.clientv2')
@section('content')
    <div class="breadcrumb-area pt-205 pb-210" style="background-image: url(../ezone/assets/img/bg/Samsung-sgalaxy-note-9-banner-web.jpg)">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2 style="color: black;">product details</h2>
                <ul>
                    <li><a href="#" style="color: black;">home /</a></li>
                    <li><a href="{{ url('/') }}/category/{{ $productDetail[0]->category_id }}" style="color: black;">{{ $breadcrumb['category'] }} /</a></li>
                    <li style="color: black;">{{ $breadcrumb['product'] }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            <div class="product-details-large tab-content">
                                <?php $images = explode(",", $productDetail[0]->images) ?>
                                @for ($i=1; $i< count($images); $i++)
                                    @if($i == 1)
                                    <div class="tab-pane active show fade" id="pro-details{{ $i }}" role="tabpanel">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href="../images/{{ $images[$i] }}">
                                                <img src="../images/{{ $images[$i] }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="tab-pane fade" id="pro-details{{ $i }}" role="tabpanel">
                                        <div class="easyzoom easyzoom--overlay">
                                            <a href=".../images/{{ $images[$i] }}">
                                                <img src="../images/{{ $images[$i] }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                @endfor
                            </div>
                            <div class="product-details-small nav mt-12" role=tablist>
                                @for ($i=1; $i< count($images); $i++)
                                    @if($i == 1)
                                    <a class="active mr-12" href="#pro-details{{ $i }}" data-toggle="tab" role="tab"
                                        aria-selected="true">
                                        <img src="../images/{{ $images[$i] }}" alt="" width="141" height="135">
                                    </a>
                                    @else
                                    <a class="mr-12" href="#pro-details{{ $i }}" data-toggle="tab" role="tab"
                                        aria-selected="true">
                                        <img src="../images/{{ $images[$i] }}" alt="" width="141" height="135">
                                    </a>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h3>{{ $productDetail[0]->title }}</h3>
                        <div class="rating-number">
                            <div class="quick-view-rating">
                                <i class="pe-7s-star red-star"></i>
                                <i class="pe-7s-star red-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                                <i class="pe-7s-star"></i>
                            </div>
                            <div class="quick-view-number">
                                <span>2 Ratting (S)</span>
                            </div>
                        </div>
                        <div class="details-price">
                            <span>${{ $productDetail[0]->price }}</span>
                        </div>
                        <p>{!! $productDetail[0]->short_description !!}</p>

                        <div class="quickview-btn-cart" style="margin-left: 0px;">
                            <a class="btn-hover-black" href="#" data-toggle="modal" data-target="#thong-tin-cau-hinh">Xem c???u h??nh chi ti???t</a>
                        </div>

                        <div class="quickview-plus-minus">
                            <div class="cart-plus-minus">
                                <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                            </div>

                            <div class="quickview-btn-cart">
                                <a href="javascript:void(0)" class="btn-hover-black" data-quantity="1" data-product-id="{{ $productDetail[0]->id }}" data-price="{{ $productDetail[0]->price }}" data-name="{{ $productDetail[0]->title }}">add to cart</a>
                            </div>
                            <div class="quickview-btn-wishlist">
                                <a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
                            </div>
                        </div>
                        <div class="product-details-cati-tag mt-35">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a href="#">{{ $productDetail[0]->category->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-description-review-area pb-90">
        <div class="container">
            <div class="product-description-review text-center">
                <div class="description-review-title nav" role=tablist>
                    <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                        Description
                    </a>
                    <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                        Reviews (0)
                    </a>
                </div>
                <div class="description-review-text tab-content">
                    <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">
                        <p>{!! $productDetail[0]->description !!}</p>
                    </div>
                    <div class="tab-pane fade" id="pro-review" role="tabpanel">
                        <a href="#">Be the first to write your review!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product area start -->
    <div class="product-area pb-95">
        <div class="container">
            <div class="section-title-3 text-center mb-50">
                <h2>Related products</h2>
            </div>
            <div class="product-style">
                <div class="related-product-active owl-carousel">
                    @foreach ($productRelated as $product)
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="{{ url('/') }}/product/{{ $product->id }}">
                                <img src="../images/<?php echo explode(",", $product->images)[1] ?>" alt="">
                            </a>
                            <span>hot</span>
                            <div class="product-action">
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-top" title="Add To Cart" href="#">
                                    <i class="pe-7s-cart"></i>
                                </a>
                                <a class="animate-right" title="Quick View" data-toggle="modal" data-target="#exampleModal"
                                    href="#">
                                    <i class="pe-7s-look"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="#">{{ $product->title }}</a></h4>
                            <span>${{ $product->price }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- product area end -->

    {{--  modal thong tin chi tiet  --}}
    <div class="modal fade" id="thong-tin-cau-hinh" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="pe-7s-close" aria-hidden="true"></span>
        </button>
        <div class="modal-dialog modal-compare-width" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="#">
                        <div class="table-content compare-style table-responsive">
                            {!! $productDetail[0]->specification !!}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

       $(document).on('click', '.btn-hover-black', function(e) {
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
