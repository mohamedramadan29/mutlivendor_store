@extends('new_website.layouts.master')
@section('title')
    سلة المشتريات
@endsection
@section('content')

    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container" dir="rtl">
            <h2 class="page-title"> اتمام الطلب </h2>
            <div class="checkout-steps">
                <a href="{{url('cart/show')}}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
            <span> سلة المشتريات  </span>
            <em>  تحكم في عناصر السلة </em>
          </span>
                </a>
                <a href="{{url('checkout')}}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
            <span>  اتمام الطلب</span>
            <em> اتمام الطلب الخاص بك  </em>
          </span>
                </a>

            </div>
            <form name="checkout-form" method="post" action="{{url('checkout')}}">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <h4> معلومات الشحن  </h4>
                        @if(Session::has('Success_message'))
                            <div
                                class="alert alert-success"> {{Session::get('Success_message')}} </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_first_name" name="name"
                                           placeholder=" الاسم  " value="{{Auth::user()->name}}">
                                    <label for="checkout_first_name"> الاسم </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="email" class="form-control" id="checkout_first_name" name="email"
                                           placeholder=" البريد الالكتروني " value="{{Auth::user()->email}}">
                                    <label for="checkout_first_name"> البريد الالكتروني </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_company_name" name="address"
                                           placeholder="العنوان" value="{{Auth::user()->address}}">
                                    <label for="checkout_company_name"> العنوان </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_company_name" name="state"
                                           placeholder="الولايه" value="{{Auth::user()->state}}">
                                    <label for="checkout_company_name"> الولايه </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_company_name" name="country"
                                           placeholder="الدوله" value="{{Auth::user()->country}}">
                                    <label for="checkout_company_name"> الدوله </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_company_name" name="city"
                                           placeholder="المدينة" value="{{Auth::user()->city}}">
                                    <label for="checkout_company_name"> المدينة </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_company_name" name="pincode"
                                           placeholder="الرمز البريدي" value="{{Auth::user()->pincode}}">
                                    <label for="checkout_company_name"> الرمز البريدي </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" id="checkout_company_name" name="mobile"
                                           placeholder="رقم الهاتف" value="{{Auth::user()->mobile}}">
                                    <label for="checkout_company_name"> رقم الهاتف </label>
                                </div>
                            </div>
                        </div>
                        {{--                    <div class="col-md-12">--}}
                        {{--                        <div class="mt-3">--}}
                        {{--                            <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)"--}}
                        {{--                                      cols="30" rows="8"></textarea>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3> طلبك </h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                    <tr>
                                        <th> المنتج </th>
                                        <th> المجموع الفرعي  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $total_price = 0; @endphp
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                {{$item['productdata']['name']}} x {{$item['quantity']}}
                                            </td>
                                            <td>
                                                $ {{$item['productdata']['price'] * $item['quantity']}}
                                            </td>
                                        </tr>
                                        @php $sub_total = $item['productdata']['price'] * $item['quantity']; @endphp
                                        @php $total_price = $total_price + $sub_total @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                    <tr>
                                        <th> المجموع الفرعي </th>
                                        <td>  {{ $total_price }} ر.س </td>
                                    </tr>
                                    <tr>
                                        <th> الشحن  </th>
                                        <td> شحن مجاني  </td>
                                    </tr>
                                    {{--                                    <tr>--}}
                                    {{--                                        <th>VAT</th>--}}
                                    {{--                                        <td>$19</td>--}}
                                    {{--                                    </tr>--}}
                                    @if(Session::has('coupon_amount'))
                                        <tr>
                                            <th> قيمة الخصم</th>
                                            <td>ر.س  {{Session::get("coupon_amount")}} </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th> المجموع  </th>
                                        <td>
                                            @if(Session::has('coupon_amount'))
                                                {{$total_price - Session::get('coupon_amount')}}
                                            @else
                                                {{$total_price}}
                                            @endif
                                                ر.س
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__payment-methods">
                                <div>
                                    <h5> حدد وسيله الدفع  </h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentmethod"
                                               id="flexRadioDefault1" value="cod">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            الدفع عند الاستلام
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentmethod"
                                               id="paypal" value="paypal">
                                        <label class="form-check-label" for="paypal">
                                            الدفع اون لاين
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <input required type="checkbox" name="accept" class="" id="accept">
                                        <label for="accept"> اوافق علي الشروط والاحكام </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"> اتمام الطلب  </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <div class="mb-5 pb-xl-5"></div>

@endsection
