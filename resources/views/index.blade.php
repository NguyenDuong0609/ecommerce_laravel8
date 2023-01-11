@extends('layouts.client')
@section('content')
<div class="electronic-banner-area">
    <div class="custom-row-2">
        <div class="custom-col-style-2 electronic-banner-col-3 mb-30">
            <div class="electronic-banner-wrapper">
                <img src="ezone/assets/img/banner/samsung-390-210-390x210-1.png" alt="">
                {{--  <div class="electro-banner-style electro-banner-position">
                    <h1>Live 4K! </h1>
                    <h2>up to 20% off</h2>
                    <h4>Amazon exclusives</h4>
                    <a href="#">Buy Now→</a>
                </div>  --}}
            </div>
        </div>
        <div class="custom-col-style-2 electronic-banner-col-3 mb-30">
            <div class="electronic-banner-wrapper">
                <img src="ezone/assets/img/banner/DT-390x210.png" alt="">
                {{--  <div class="electro-banner-style electro-banner-position2">
                    <h1>Xoxo ssl </h1>
                    <h2>up to 15% off</h2>
                    <h4>Amazon exclusives</h4>
                    <a href="#">Buy Now→</a>
                </div>  --}}
            </div>
        </div>
        <div class="custom-col-style-2 electronic-banner-col-3 mb-30">
            <div class="electronic-banner-wrapper">
                <img src="ezone/assets/img/banner/Laptop2-390x210.png" alt="">
                {{--  <div class="electro-banner-style electro-banner-position3">
                    <h1>BY Laptop</h1>
                    <h2>Super Discount</h2>
                    <h4>Amazon exclusives</h4>
                    <a href="#">Buy Now→</a>
                </div>  --}}
            </div>
        </div>
    </div>
</div>
<div class="electro-product-wrapper wrapper-padding pt-95 pb-45">
    <div class="container-fluid">
        <div class="section-title-4 text-center mb-40">
            <h2>Top Products</h2>
        </div>
        <div class="top-product-style">
            <div class="product-tab-list3 text-center mb-80 nav product-menu-mrg" role="tablist">
                <a class="active" href="#" data-toggle="tab" role="tab">
                    <h4>Fiction </h4>
                </a>
                <a href="#" data-toggle="tab" role="tab">
                    <h4>Satire </h4>
                </a>
                <a href="#" data-toggle="tab" role="tab">
                    <h4>Anthologies</h4>
                </a>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="electro1" role="tabpanel">
                    <div class="custom-row-2">
                        @if(count($topProducts) >0)
                            @foreach ($topProducts as $product)
                            <div class="custom-col-style-2 custom-col-4">
                                <div class="product-wrapper product-border mb-24">
                                    <div class="product-img-3">
                                        <a href="{{ env('DOMAIN') }}/product/{{ $product->id }}">
                                            {{--  <img src="images/<?php echo explode(",", $product->images)[1] ?>" alt="">  --}}
                                            <img src="<?php echo env('AWS_URL').$product->images ?>" alt="">
                                        </a>
                                        <div class="product-action-right">
                                            {{--  <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                <i class="pe-7s-look"></i>
                                            </a>  --}}
                                            <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}"><i class="pe-7s-cart"></i></a>
                                            <a class="animate-left" title="Wishlist" href="#">
                                                <i class="pe-7s-like"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content-4 text-center">
                                        <div class="product-rating-4">
                                            <i class="icofont icofont-star yellow"></i>
                                            <i class="icofont icofont-star yellow"></i>
                                            <i class="icofont icofont-star yellow"></i>
                                            <i class="icofont icofont-star yellow"></i>
                                            <i class="icofont icofont-star"></i>
                                        </div>
                                        <h4><a href="#">{{ $product->title }}</a></h4>
                                        <span>{{ $product->category->name }}</span>
                                        <h5>${{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <h3>No Data</h3>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="electro2" role="tabpanel">
                    <div class="custom-row-2">
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/8.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}"><i class="pe-7s-cart"></i></a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">First Air Headphone Black</a></h4>
                                    <span>Headphone</span>
                                    <h5>$133.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/7.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Full Bast Doule Speaker</a></h4>
                                    <span>Headphone</span>
                                    <h5>$110.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/6.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Xo GoPro Hero</a></h4>
                                    <span>Headphone</span>
                                    <h5>$133.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/5.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Twin Wash Dual</a></h4>
                                    <span>Headphone</span>
                                    <h5>$120.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/4.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Play Station Suporting</a></h4>
                                    <span>Headphone</span>
                                    <h5>$180.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/3.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Cannon D300R</a></h4>
                                    <span>Headphone</span>
                                    <h5>$170.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/2.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Wifi Printer For Office</a></h4>
                                    <span>Headphone</span>
                                    <h5>$150.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/1.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Featured Tab Windows</a></h4>
                                    <span>Headphone</span>
                                    <h5>$145.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="electro3" role="tabpanel">
                    <div class="custom-row-2">
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/4.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">First Air Headphone Black</a></h4>
                                    <span>Headphone</span>
                                    <h5>$133.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/3.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Full Bast Doule Speaker</a></h4>
                                    <span>Headphone</span>
                                    <h5>$110.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/2.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Xo GoPro Hero</a></h4>
                                    <span>Headphone</span>
                                    <h5>$133.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/1.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Twin Wash Dual</a></h4>
                                    <span>Headphone</span>
                                    <h5>$120.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/8.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Play Station Suporting</a></h4>
                                    <span>Headphone</span>
                                    <h5>$180.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/7.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Cannon D300R</a></h4>
                                    <span>Headphone</span>
                                    <h5>$170.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/6.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Wifi Printer For Office</a></h4>
                                    <span>Headphone</span>
                                    <h5>$150.00</h5>
                                </div>
                            </div>
                        </div>
                        <div class="custom-col-style-2 custom-col-4">
                            <div class="product-wrapper product-border mb-24">
                                <div class="product-img-3">
                                    <a href="#">
                                        <img src="ezone/assets/img/product/electro/5.jpg" alt="">
                                    </a>
                                    <div class="product-action-right">
                                        <a class="animate-right" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                            <i class="pe-7s-look"></i>
                                        </a>
                                        <a class="animate-top" title="Add To Cart" href="#">
                                            <i class="pe-7s-cart"></i>
                                        </a>
                                        <a class="animate-left" title="Wishlist" href="#">
                                            <i class="pe-7s-like"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-4 text-center">
                                    <div class="product-rating-4">
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star yellow"></i>
                                        <i class="icofont icofont-star"></i>
                                    </div>
                                    <h4><a href="#">Featured Tab Windows</a></h4>
                                    <span>Headphone</span>
                                    <h5>$145.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="banner-area wrapper-padding pt-30 pb-95">
    <div class="container-fluid">
        <div class="electro-fexible-banner bg-img" style="background-image: url(ezone/assets/img/banner/banner_1520x320.jpg)">
            <div class="fexible-content">
                <h3 style="color: white;">Play with flexible</h3>
                <p style="color: white;">Multicontrol Smooth Controller, Black Color All Buttons
                    <br style="color: white;">are somooth, Super Shine.</p>
                <a class="btn-hover flexible-btn" href="#" style="color: white;">Buy Now</a>
            </div>
        </div>
    </div>
</div>
<div class="best-selling-area pb-95">
    <div class="section-title-4 text-center mb-60">
        <h2>Best Selling</h2>
    </div>
    <div class="best-selling-product">
        <div class="row no-gutters">
            <div class="col-lg-5">
                <div class="best-selling-left">
                    <div class="product-wrapper">
                        <div class="product-img-4">
                            <a href="{{ env('DOMAIN') }}/product/{{ $sellerProducts[0]->id }}">
                                {{--  <img src="images/<?php echo explode(",", $sellerProducts[0]->images)[1] ?>" alt="">  --}}
                                <img src="<?php echo env('AWS_URL').$sellerProducts[0]->images ?>" alt="" style="width: 80%; height: 20%">
                            </a>
                            <div class="product-action-right">
                                <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}"><i class="pe-7s-cart"></i></a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content-5 text-center">
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                            </div>
                            <h4><a href="{{ env('DOMAIN') }}/product/{{ $sellerProducts[0]->id }}" style="color: white;">{{ $sellerProducts[0]->title }}</a></h4>
                            <span style="color: white;">{{ $sellerProducts[0]->category->name }}</span>
                            <h5 style="color: white;">${{ $sellerProducts[0]->price }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="best-selling-right">
                    <div class="custom-container">
                        <div class="coustom-row-3">
                            @if(count($sellerProducts) >0)
                                @foreach ($sellerProducts as $product)
                                <div class="custom-col-style-3 custom-col-3">
                                    <div class="product-wrapper mb-6">
                                        <div class="product-img-4">
                                            <a href="{{ env('DOMAIN') }}/product/{{ $product->id }}">
                                                {{--  <img src="images/<?php echo explode(",", $product->images)[1] ?>" alt="">  --}}
                                                <img src="<?php echo env('AWS_URL').$product->images ?>" alt="">
                                            </a>
                                            <div class="product-action-right">
                                                <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}"><i class="pe-7s-cart"></i></a>
                                                <a class="animate-left" title="Wishlist" href="#">
                                                    <i class="pe-7s-like"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-6">
                                            <div class="product-rating-4">
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                                <i class="icofont icofont-star yellow"></i>
                                            </div>
                                            <h4><a href="#" style="color: white;">{{ $product->title }}</a></h4>
                                            <h5 style="color: white;">${{ $product->price }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="androit-banner-wrapper wrapper-padding pb-175">
    <div class="container-fluid">
        <div class="androit-banner-img bg-img" style="background-image: url(ezone/assets/img/banner/seller_banner.jpg)">
            <div class="androit-banner-content">
                <h3>Xolo Fast T2 Smartphone, Android <br>7.0 Unlocked.</h3>
                <a href="#">Buy Now →</a>
            </div>
            <div class="banner-price text-center">
                <div class="banner-price-position">
                    <span class="banner-price-new">$125.00</span>
                    <span class="banner-price-old">$199.00</span>
                </div>
            </div>
            <div class="phn-img">
                <img src="ezone/assets/img/banner/apple-macbook-air-2020-gold_gtmo-h2.png" alt="">
            </div>
        </div>
    </div>
</div>
<div class="product-area-2 wrapper-padding pb-70">
    <div class="container-fluid">
        <div class="row">
            @if(count($newProducts) >0)
                @foreach ($newProducts as $product)
                <div class="col-lg-6 col-xl-4">
                    <div class="product-wrapper product-wrapper-border mb-30">
                        <div class="product-img-5">
                            <a href="{{ env('DOMAIN') }}/product/{{ $product->id }}">
                                {{--  <img src="images/<?php echo explode(",", $product->images)[1] ?>" alt="" width="189px" height="190px">  --}}
                                <img src="<?php echo env('AWS_URL').$product->images ?>" alt="" width="189px" height="190px">
                            </a>
                        </div>
                        <div class="product-content-7">
                            <h4><a href="#">{{ $product->title }}</a></h4>
                            <div class="product-rating-4">
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star yellow"></i>
                                <i class="icofont icofont-star"></i>
                            </div>
                            <h5>${{ $product->price }}</h5>
                            <div class="product-action-electro">
                                <a href="javascript:void(0)" class="animate-top" title="Add To Cart" data-quantity="1" data-product-id="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->title }}"><i class="pe-7s-cart"></i></a>
                                <a class="animate-left" title="Wishlist" href="#">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <a class="animate-right" title="Compare" data-toggle="modal" data-target="#exampleCompare" href="#">
                                    <i class="pe-7s-repeat"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="brand-logo-area-2 wrapper-padding ptb-80">
    <div class="container-fluid">
        <div class="brand-logo-active2 owl-carousel">
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/7.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/8.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/9.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/10.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/11.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/12.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/13.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/7.png" alt="">
            </div>
            <div class="single-brand">
                <img src="ezone/assets/img/brand-logo/8.png" alt="">
            </div>
        </div>
    </div>
</div>
<div class="newsletter-area ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="section-title-5">
                    <h2>Newsletter</h2>
                    <p>Sign Up for get all update news & Get <span>15% off</span></p>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="newsletter-style-3">
                    <div id="mc_embed_signup" class="subscribe-form-3 pr-50">
                        <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll" class="mc-form">
                                <input type="email" value="" name="EMAIL" class="email" placeholder="Enter Your E-mail" required>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div class="mc-news" aria-hidden="true">
                                    <input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value="">
                                </div>
                                <div class="clear">
                                    <input type="button" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.animate-top', function(e) {
        console.log('click');
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');
        var product_price = $(this).data('price');
        var product_name = $(this).data('name');
        var image = $(this).data('image');

        var token = "{{ csrf_token() }}";
        var path = "http://laravel.nguyenduongdev.com/cart/store";

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
</script>
@stop
