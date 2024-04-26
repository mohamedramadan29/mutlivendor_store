@extends('new_website.layouts.master')
@section('title')
    سلة المشتريات
@endsection
@section('content')
    <main>
        @if($item_counts > 0)
            <div class="mb-4 pb-4"></div>
            <section class="shop-checkout container" dir="rtl">
                <h2 class="page-title"> سلة المشتريات  </h2>
                <div class="checkout-steps">
                    <a href="{{url('cart/show')}}" class="checkout-steps__item active">
                        <span class="checkout-steps__item-number">01</span>
                        <span class="checkout-steps__item-title">
            <span> سلة المشتريات  </span>
            <em> تحكم في عناصر السلة  </em>
          </span>
                    </a>
                    <a href="{{url('checkout')}}" class="checkout-steps__item">
                        <span class="checkout-steps__item-number">02</span>
                        <span class="checkout-steps__item-title">
            <span>  اتمام الطلب   </span>
            <em> اتمام الطلب الخاص بك  </em>
          </span>
                    </a>

                </div>

                <div class="shopping-cart">

                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                            <tr>
                                <th> المنتج  </th>
                                <th></th>
                                <th> السعر  </th>
                                <th> الكمية  </th>
                                <th> المجموع  </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total_price = 0; @endphp
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <a href="{{url('product_details/'.$item['productdata']['slug'])}}">
                                                <img loading="lazy"
                                                     src="{{Storage::url($item['productdata']['image'])}}" width="120"
                                                     height="120"
                                                     alt="">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>
                                                <a href="{{url('product_details/'.$item['productdata']['slug'])}}">  {{$item['productdata']['name']}}  </a>
                                            </h4>

                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="shopping-cart__product-price">  {{$item['productdata']['price']}}  ر.س  </span>
                                    </td>
                                    <td>
                                        <div class="qty-control position-relative">
                                            <div class="quantity">
                                                <div class="control">
                                                    <input type="number" name="quantity" value="{{$item['quantity']}}"
                                                           min="1"
                                                           class="qty-control__number text-center">
                                                    <div data-cartid="{{$item['id']}}" data-qty="{{$item['quantity']}}"
                                                         class="qty-control__reduce btn-number qtyminus quantity-minus updateCartItem">
                                                        -
                                                    </div>
                                                    <div data-cartid="{{$item['id']}}" data-qty="{{$item['quantity']}}"
                                                         class="qty-control__increase btn-number qtyplus quantity-plus updateCartItem">
                                                        +
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .qty-control -->
                                    </td>
                                    <td>
                                    <span class="shopping-cart__subtotal">
                                        @php $sub_total = $item['productdata']['price'] * $item['quantity']; @endphp
                                        {{$sub_total}} ر.س

                                    </span>
                                    </td>
                                    <td>
                                        <a style="cursor:pointer;" class="remove btn-sm deleteCartItem" data-cartid="{{$item['id']}}">
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z"/>
                                                <path
                                                    d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $total_price = $total_price + $sub_total @endphp
                            @endforeach



                            </tbody>
                        </table>
                        <div class="cart-table-footer">
                            <form class="position-relative bg-body" id="applycoupon" method="post"
                                  action="javascript:void(0);"
                                  @if(\Illuminate\Support\Facades\Auth::check()) user = "1" @endif>
                                @csrf
                                <div class="coupon">
                                    <input id="code" required name="code" type="text" class="input-text form-control"
                                           placeholder="ادخل كود الخصم هنا ">
                                    {{--                                    <button type="submit" class="button"> تاكيد الكوبون</button>--}}
                                    <input class="btn-link fw-medium position-absolute top-0 h-100 px-4"
                                           type="submit" style="left: 0"
                                           value="تاكيد الكوبون ">
                                </div>
                            </form>
                            <div class="order-total">
                                @if(Session::has('coupon_amount'))
                                    <span class="title">
                                                         قيمه الخصم :
                                                    </span>
                                    <span class="total-price discountAmount">

                                                      {{Session::get("coupon_amount")}} <span> ر.س </span>
                                                    </span>
                                @endif
                            </div>
                            <a href="{{url('cart/show')}}" class="btn btn-light"> تحديث السلة  </a>
                        </div>
                    </div>
                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3> مجموع السلة </h3>
                                <table class="cart-totals">
                                    <tbody>
                                    <tr>
                                        <th> المجموع الفرعي  </th>

                                        <td> {{$total_price}} ر.س </td>
                                    </tr>
                                    <tr>
                                        <th> الشحن  </th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="checkbox"
                                                       value="" id="free_shipping">
                                                <label class="form-check-label" for="free_shipping"> شحن مجاني  </label>
                                            </div>
                                            {{--                                            <div class="form-check">--}}
                                            {{--                                                <input class="form-check-input form-check-input_fill" type="checkbox"--}}
                                            {{--                                                       value="" id="flat_rate">--}}
                                            {{--                                                <label class="form-check-label" for="flat_rate">Flat rate: $49</label>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="form-check">--}}
                                            {{--                                                <input class="form-check-input form-check-input_fill" type="checkbox"--}}
                                            {{--                                                       value="" id="local_pickup">--}}
                                            {{--                                                <label class="form-check-label" for="local_pickup">Local pickup:--}}
                                            {{--                                                    $8</label>--}}
                                            {{--                                            </div>--}}
                                            <div>Shipping to AL.</div>
                                            <div>
                                                <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                            </div>
                                        </td>
                                    </tr>
                                    {{--                                    <tr>--}}
                                    {{--                                        <th>VAT</th>--}}
                                    {{--                                        <td>$19</td>--}}
                                    {{--                                    </tr>--}}
                                    <tr>
                                        <th> المجموع  </th>
                                        <td>
                                            @if(Session::has('coupon_amount'))
                                                {{$total_price - Session::get('coupon_amount')}} <span> ر.س </span>

                                            @else

                                                {{$total_price}} <span> ر.س </span>

                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="button-wrapper container">
                                    <a href="{{url('checkout')}}" class="btn btn-primary"> اتمام عملية الدفع  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="container text-center m-auto">
                        <br>
                        <div class="control-cart">
                            <div class="alert alert-info"> لا يوجد منتجات في سله المشتريات</div>
                            <div class="button-wrapper container">
                                <a class="btn btn-primary btn-checkout" href="{{url('shop')}}"> تسوق الان  </a>
                            </div>

                        </div>
                    </div>

                @endif
            </section>

    </main>

    <div class="mb-5 pb-xl-5"></div>

@endsection
