@extends('new_website.layouts.master')
@section('title')
     فشل عملية الدفع
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container" dir="rtl">
            <h2 class="page-title">  فشل عملية الدفع    </h2>
            <div class="checkout-steps">
                <a href="{{url('cart/show')}}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">

          </span>
                </a>
                <a href="{{url('checkout')}}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
            <span> فشل عملية الدفع  </span>
          </span>
                </a>
                <a href="{{url('thanks')}}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
            <span>فشل عملية الدفع     </span>
          </span>
                </a>
            </div>
            <div class="order-complete">
                <div class="order-complete__message">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="40" fill="#B9A16B"/>
                        <path d="M52.9743 35.7612C52.9743 35.3426 52.8069 34.9241 52.5056 34.6228L50.2288 32.346C49.9275 32.0446 49.5089 31.8772 49.0904 31.8772C48.6719 31.8772 48.2533 32.0446 47.952 32.346L36.9699 43.3449L32.048 38.4062C31.7467 38.1049 31.3281 37.9375 30.9096 37.9375C30.4911 37.9375 30.0725 38.1049 29.7712 38.4062L27.4944 40.683C27.1931 40.9844 27.0257 41.4029 27.0257 41.8214C27.0257 42.24 27.1931 42.6585 27.4944 42.9598L33.5547 49.0201L35.8315 51.2969C36.1328 51.5982 36.5513 51.7656 36.9699 51.7656C37.3884 51.7656 37.8069 51.5982 38.1083 51.2969L40.385 49.0201L52.5056 36.8996C52.8069 36.5982 52.9743 36.1797 52.9743 35.7612Z" fill="white"/>
                    </svg>
                    <h3> فشل عملية الدفع حاول مرة اخري   </h3>
                    <p>فشل عملية الدفع  </p>
                </div>
                <div class="order-info">
                    @php
                        $order = \App\Models\Order::where('id',\Illuminate\Support\Facades\Session::get('order_id'))->first();
                    @endphp
                    <div class="order-info__item">
                        <label> رقم الطلب  </label>
                        <span> {{ \Illuminate\Support\Facades\Session::get('order_id') }}</span>
                    </div>
                    <div class="order-info__item">
                        <label> التاريخ  </label>
                        <span> {{$order['created_at']}} </span>
                    </div>
                    <div class="order-info__item">
                        <label> المجموع  </label>
                        <span>$ {{$order['grand_total']}} </span>
                    </div>
                    <div class="order-info__item">
                        <label> وسيلة الدفع  </label>
                        <span> {{$order['payment_method']}} </span>
                    </div>

                </div>
                <div class="d-flex justify-content-around">
                    <a class="btn btn-primary" href="{{url('user/profile')}}"> حسابي  </a>
                    <a class="btn btn-primary" href="{{url('/')}}"> الرئيسية  </a>
                </div>
            </div>
        </section>
    </main>

    <div class="mb-5 pb-xl-5"></div>

@endsection
