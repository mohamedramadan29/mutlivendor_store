@extends('website.layouts.master')
@section('title')
    اتمام عمليه الدفع
@endsection
@section('content')
    <div class="main-content main-content-checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{url('/')}}"> الرئيسيه </a>
                            </li>
                            <li class="trail-item trail-end active">
                                اتمام عمليه الدفع
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3 class="custom_blog_title">
                اتمام عمليه الدفع
            </h3>
            <div class="checkout-wrapp">
                <form method="post" action="{{url('checkout')}}">
                    @csrf

                <div class="shipping-address-form-wrapp">
                    <div class="shipping-address-form  checkout-form">
                        <div class="row-col-1 row-col">
                            <div class="shipping-address">
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
                                <h3 class="title-form">
                                    معلومات الشحن
                                </h3>
                                <p class="form-row form-row-first">
                                    <label class="text"> الاسم </label>
                                    <input required title="name" type="text" name="name" class="input-text"
                                           value="{{Auth::user()->name}}">
                                </p>
                                <p class="form-row forn-row-col forn-row-col-1">
                                    <label class="text"> العنوان </label>
                                    <input required title="name" type="text" name="address" class="input-text"
                                           value="@if(isset($_REQUEST['address'])) {{old('address')}} @else {{Auth::user()->address}} @endif">
                                </p>
                                <p class="form-row forn-row-col forn-row-col-1">
                                    <label class="text"> المدينه </label>
                                    <input required title="name" type="text" name="city" class="input-text"
                                           value="{{Auth::user()->city}}">
                                </p>
                                <p class="form-row forn-row-col forn-row-col-1">
                                    <label class="text"> الولايه </label>
                                    <input required title="name" type="text" name="state" class="input-text"
                                           value="{{Auth::user()->state}}">
                                </p>
                                <p class="form-row forn-row-col forn-row-col-1">
                                    <label class="text">الدوله </label>
                                    <input required title="name" type="text" name="country" class="input-text"
                                           value="{{Auth::user()->country}}">
                                </p>
                                <p class="form-row form-row-first">
                                    <label class="text"> الرمز البريدي </label>
                                    <input required title="zip" type="text" name="pincode" class="input-text"
                                           value="{{Auth::user()->pincode}}">
                                </p>
                                <p class="form-row form-row-first">
                                    <label class="text"> رقم الهاتف </label>
                                    <input required title="mobile" type="text" name="mobile" class="input-text"
                                           value="{{Auth::user()->mobile}}">
                                </p>
                                <p class="form-row form-row-first">
                                    <label class="text"> البريد الالكتروني </label>
                                    <input readonly disabled style="background-color: #f1f1f1" title="email" type="text"
                                           name="email" class="input-text" value="{{Auth::user()->email}}">
                                </p>

                            </div>
                        </div>
                        <div class="row-col-2 row-col">
                            <div class="your-order">
                                <h3 class="title-form">
                                    طلبك
                                </h3>
                                <ul class="list-product-order">
                                    @php $total_price = 0; @endphp
                                    @foreach($cartItems as $item)
                                        <li class="product-item-order">
                                            <div class="product-thumb">
                                                <a href="#">
                                                    <img src="{{Storage::url($item['productdata']['image'])}}"
                                                         alt="img">
                                                </a>
                                            </div>
                                            <div class="product-order-inner">
                                                <h5 class="product-name">
                                                    <a href="{{url('product_details/'.$item['productdata']['slug'])}}">{{$item['productdata']['name']}}</a>
                                                </h5>
                                                <div class="price">

                                                    @if($item['productdata']['discount'] != 0 && $item['productdata']['discount'] != null )

                                                        <span
                                                            class="attributes-select attributes-size"> {{ $item['productdata']['price'] - $item['productdata']['discount']}} </span>
                                                    @else

                                                        <span
                                                            class="attributes-select attributes-size">  {{$item['productdata']['price']}} </span>
                                                    @endif

                                                    <span class="count">x{{$item['quantity']}}</span>
                                                </div>
                                            </div>
                                        </li>
                                        @if($item['productdata']['discount'] != 0 && $item['productdata']['discount'] != null )
                                            @php $sub_total = ($item['productdata']['price'] - $item['productdata']['discount']) * $item['quantity']; @endphp
                                        @else
                                            @php $sub_total = $item['productdata']['price'] * $item['quantity']; @endphp
                                        @endif
                                        @php $total_price = $total_price + $sub_total @endphp
                                    @endforeach

                                </ul>
                                <div class="order-total">
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
                                    <span class="title">
                                    السعر الكلي :
                                </span>
                                    <span class="total-price">
                                          <span class="total-price grand_total">
                                @if(Session::has('coupon_amount'))
                                                  {{$total_price - Session::get('coupon_amount')}} <span> ر.س </span>
                                                    </span>
                            @else
                                            <span class="total-price grand_total">

                                        {{$total_price}} <span> ر.س </span>
                                                    </span>
                                        @endif
                                </span>
                                </div>
                            </div>
                        </div>
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
                                       id="flexRadioDefault2" value="online_tap">
                                <label class="form-check-label" for="flexRadioDefault2">
                                   الدفع اون لاين
                                </label>
                            </div>
                            <div class="form-group">
                                <input required type="checkbox" name="accept" class="" id="accept">
                                <label for="accept"> اوافق علي الشروط والاحكام </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="button button-payment"> الدفع</button>
                </div>
                </form>
                <div class="end-checkout-wrapp">
                    <div class="end-checkout checkout-form">
                        <div class="icon">
                        </div>
                        <h3 class="title-checkend">
                            ررائع تم الطلب بنجاح !
                        </h3>
                        <div class="sub-title">
                            تسطيع مشاهده طلبك والتقدم من خلال الحساب الخاص بك
                        </div>
                        <a href="#" class="button btn-return"> الرجوع الي الرئيسيه </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
