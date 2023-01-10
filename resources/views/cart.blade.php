@extends('layouts.clientv2')
@section('content')
    <div class="breadcrumb-area pt-205 pb-210" style="background-image: url(../ezone/assets/img/bg/iphone.jpg)">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>cart page</h2>
                <ul>
                    <li><a href="{{ env('DOMAIN') }}">home</a></li>
                    <li style="color: black;">cart page</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area start -->
    <div id="statusCoupon"></div>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="cart-heading">Cart</h1>
                    <form action="{{ route('cart.update') }}">
                        {{ csrf_field() }}
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>remove</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $row)
                                    <tr>
                                        <td class="product-remove"><a href="#" data-product-id="{{ $row->rowId }}"><i class="pe-7s-close" data-product-id="{{ $row->rowId }}"></i></a></td>
                                        <td class="product-name"><a href="#">{{ $row->name }}</a></td>
                                        <td class="product-price-cart"><span class="amount">${{ $row->price }}</span></td>
                                        <td class="product-quantity">
                                            <input value="{{ $row->qty }}" name="qty[]" type="number">
                                        </td>
                                        <td class="product-subtotal">${{ $row->qty * $row->price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                            placeholder="Coupon code" type="text">
                                            <input class="button" id="apply_coupon" name="apply_coupon" value="Apply coupon"
                                                type="button">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Discount<span>- {{ Cart::discount() }}</span></li>
                                        <li>Tax<span>{{ Cart::tax() }}</span></li>
                                        <li>Total<span>{{ Cart::total() }}</span></li>
                                    </ul>
                                    <a href="{{ env('DOMAIN') }}/checkout">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- shopping-cart-area end -->
    <script type="text/javascript">
        $(document).on('click', '.pe-7s-close', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";

            $.ajax({
                url: path,
                type: "DELETE",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: token,
                },
                success: function(data) {
                    console.log(data);
                    window.location.reload();
                }
            })
        });

        $(document).on('click', '#apply_coupon', function(e) {
            e.preventDefault();
            var coupon_code =  $('input[name = coupon_code]').val();
            var path = "{{ route('cart.coupon') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    coupon_code: coupon_code,
                },
                success: function(data) {
                    if(data['status'] == 500) {
                        $("#statusCoupon").html(' <div class=\"alert alert-success\" role=\"alert\" style=\"text-align: center\">'+ data['errors']+'</div>');
                    } else {
                        $("#statusCoupon").html(' <div class=\"alert alert-success\" role=\"alert\" style=\"text-align: center\">'+ data['data']+'</div>');
                    }
                }
            })
        });
     </script>
@stop
