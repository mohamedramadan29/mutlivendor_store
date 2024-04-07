@extends('website.layouts.master')
@section('title') الرئيسية   @endsection
@section('content')
    <div style="background-image: url('{{ asset('assets/website/images/background.png') }}');background-size: cover;background-position: center">
        <div class="fullwidth-template">
            <div class="home-slider fullwidth rows-space-60">
                <div class="slider-owl owl-slick equal-container nav-center equal-container"
                     data-slick='{"autoplay":true, "autoplaySpeed":10000, "arrows":true, "dots":true, "infinite":true, "speed":800, "rows":1}'
                     data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":1}}]'>
                    @foreach($banners as $banner)
                        <div class="slider-item style4">
                            <div class="slider-inner equal-element" style="background-image: url('{{\Illuminate\Support\Facades\Storage::url($banner->image)}}')">
                                <div class="container">
                                    <div class="slider-infor">
                                        <h5 class="title-small">
                                           {{$banner['sub_title']}}
                                        </h5>
                                        <h3 class="title-big">
                                            {{$banner['title']}}
                                        </h3>
                                        <a href="{{$banner['link']}}" class="button btn-shop-the-look bgroud-style">تسوق الان</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="stelina-product produc-featured rows-space-65">
                <div class="container">
                    <h3 class="custommenu-title-blog">
                        عروضنا
                    </h3>
                    <div class="owl-products owl-slick equal-container nav-center"
                         data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":false, "dots":true, "infinite":false, "speed":800, "rows":1}'
                         data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":4}},{"breakpoint":"1200","settings":{"slidesToShow":3}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
                       @foreach($offer_products as $product)
                            <div class="product-item style-5">
                                <div class="product-inner equal-element">
                                    <div class="product-top">

                                    </div>
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a href="#">
                                                <img src="{{Storage::url($product['image'])}}" alt="img">
                                            </a>
                                            <div class="thumb-group">
                                                <div class="yith-wcwl-add-to-wishlist">
                                                    <div class="yith-wcwl-add-button">
                                                        <a href="#">Add to Wishlist</a>
                                                    </div>
                                                </div>
                                                <a href="#" class="button quick-wiew-button">Quick View</a>
                                                <div class="loop-form-add-to-cart">
                                                    <button class="single_add_to_cart_button button">Add to cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h5 class="product-name product_title">
                                            <a href="#">{{$product['name']}}</a>
                                        </h5>
                                        <div class="group-info">
                                            <div class="stars-rating">
                                                <div class="star-rating">
                                                    <span class="star-3"></span>
                                                </div>
                                                <div class="count-star">
                                                    (3)
                                                </div>
                                            </div>
                                            <div class="price">
                                                <del dir="rtl">
                                                    {{$product['price']}} <span> ر.س </span>
                                                </del>
                                                <ins dir="rtl">
                                                    {{$product['price'] - $product['discount']}}   <span> ر.س </span>
                                                </ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
            <div class="banner-wrapp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="banner">
                                <div class="item-banner style4">
                                    <div class="inner">
                                        <div class="banner-content">
                                            <h4 class="stelina-subtitle">TOP STAFF PICK</h4>
                                            <h3 class="title">Best Collection</h3>
                                            <div class="description">
                                                Proin interdum magna primis id consequat
                                            </div>
                                            <a href="#" class="button btn-shop-now"> تسوق الان </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="banner">
                                <div class="item-banner style5">
                                    <div class="inner">
                                        <div class="banner-content">
                                            <h3 class="title">Maybe You’ve <br/>Earned it</h3>
                                            <span class="code">
                                            Use code:
                                            <span>
                                                STELINA
                                            </span>
                                            Get 25% Off for all items!
                                        </span>
                                            <a href="#" class="button btn-shop-now">تسوق الان </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-wrapp rows-space-65">
                <div class="container">
                    <div class="banner">
                        <div class="item-banner style17">
                            <div class="inner">
                                <div class="banner-content">
                                    <h3 class="title">Collection Arrived</h3>
                                    <div class="description">
                                        You have no items & Are you <br/>ready to use? come & shop with us!
                                    </div>
                                    <div class="banner-price">
                                        Price from:
                                        <span class="number-price"> ر.س 45.00</span>
                                    </div>
                                    <a href="#" class="button btn-shop-now">Shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stelina-tabs  default rows-space-40">
                <div class="container">
                    <div class="tab-head">
                        <ul class="tab-link">
                            <li class="active">
                                <a data-toggle="tab" aria-expanded="true" href="#bestseller"> الأفضل مبيعاً </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" aria-expanded="true" href="#new_arrivals"> احدث المنتجات </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" aria-expanded="true" href="#top-rated"> الاعلي تقيما </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-container">
                        <div id="bestseller" class="tab-panel active">
                            <div class="stelina-product">
                                <ul class="row list-products auto-clear equal-container product-grid">
                                    @foreach($best_seller as $product)
                                        <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                            <div class="product-inner equal-element">
                                                <div class="product-top">
{{--                                                    <div class="flash">--}}
{{--                                                <span class="onnew">--}}
{{--                                                    <span class="text">--}}
{{--                                                       جديد--}}
{{--                                                    </span>--}}
{{--                                                </span>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#">
                                                            <img src="{{Storage::url($product['image'])}}" alt="img">
                                                        </a>
                                                        <div class="thumb-group">
                                                            <div class="yith-wcwl-add-to-wishlist">
                                                                <div class="yith-wcwl-add-button">
                                                                    <a href="#">Add to Wishlist</a>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="button quick-wiew-button">Quick View</a>
                                                            <div class="loop-form-add-to-cart">
                                                                <button class="single_add_to_cart_button button">Add to cart
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="{{url('product_details/'.$product['id'])}}">{{$product['name']}}</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <div class="stars-rating">
                                                            <div class="star-rating">
                                                                <span class="star-3"></span>
                                                            </div>
                                                            <div class="count-star">
                                                                (3)
                                                            </div>
                                                        </div>
                                                        @if($product['discount'] != 0)
                                                            <div class="price">
                                                                <del dir="rtl">

                                                                    {{$product['price']}} <span> ر.س </span>

                                                                </del>
                                                                <ins>
                                                                    {{$product['price'] - $product['discount']}}  <span> ر.س </span>
                                                                </ins>
                                                            </div>
                                                        @else
                                                            <div class="price">

                                                                <ins dir="rtl">
                                                                    {{$product['price']}} <span> ر.س </span>
                                                                </ins>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div id="new_arrivals" class="tab-panel">
                            <div class="stelina-product">
                                <ul class="row list-products auto-clear equal-container product-grid">

                                    @foreach($new_products as $product)
                                        <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                            <div class="product-inner equal-element">
                                                <div class="product-top">
{{--                                                    <div class="flash">--}}
{{--                                                <span class="onnew">--}}
{{--                                                    <span class="text">--}}
{{--                                                       جديد--}}
{{--                                                    </span>--}}
{{--                                                </span>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#">
                                                            <img src="{{Storage::url($product['image'])}}" alt="img">
                                                        </a>
                                                        <div class="thumb-group">
                                                            <div class="yith-wcwl-add-to-wishlist">
                                                                <div class="yith-wcwl-add-button">
                                                                    <a href="#">Add to Wishlist</a>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="button quick-wiew-button">Quick View</a>
                                                            <div class="loop-form-add-to-cart">
                                                                <button class="single_add_to_cart_button button">Add to cart
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="{{url('product_details/'.$product['id'])}}">{{$product['name']}}</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <div class="stars-rating">
                                                            <div class="star-rating">
                                                                <span class="star-3"></span>
                                                            </div>
                                                            <div class="count-star">
                                                                (3)
                                                            </div>
                                                        </div>
                                                        @if($product['discount'] != 0)
                                                            <div class="price">
                                                                <del dir="rtl">

                                                                        {{$product['price']}} <span> ر.س </span>

                                                                </del>
                                                                <ins>
                                                                    {{$product['price'] - $product['discount']}}  <span> ر.س </span>
                                                                </ins>
                                                            </div>
                                                        @else
                                                            <div class="price">

                                                                <ins dir="rtl">
                                                                     {{$product['price']}} <span> ر.س </span>
                                                                </ins>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                        <div id="top-rated" class="tab-panel">
                            <div class="stelina-product">
                                <ul class="row list-products auto-clear equal-container product-grid">
                                    @foreach( $feature_products as $product)
                                        <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                            <div class="product-inner equal-element">
                                                <div class="product-top">
{{--                                                    <div class="flash">--}}
{{--                                                <span class="onnew">--}}
{{--                                                    <span class="text">--}}
{{--                                                       جديد--}}
{{--                                                    </span>--}}
{{--                                                </span>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="#">
                                                            <img src="{{Storage::url($product['image'])}}" alt="img">
                                                        </a>
                                                        <div class="thumb-group">
                                                            <div class="yith-wcwl-add-to-wishlist">
                                                                <div class="yith-wcwl-add-button">
                                                                    <a href="#">Add to Wishlist</a>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="button quick-wiew-button">Quick View</a>
                                                            <div class="loop-form-add-to-cart">
                                                                <button class="single_add_to_cart_button button">Add to cart
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="{{url('product_details/'.$product['id'])}}">{{$product['name']}}</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <div class="stars-rating">
                                                            <div class="star-rating">
                                                                <span class="star-3"></span>
                                                            </div>
                                                            <div class="count-star">
                                                                (3)
                                                            </div>
                                                        </div>
                                                        @if($product['discount'] != 0)
                                                            <div class="price">
                                                                <del dir="rtl">

                                                                    {{$product['price']}} <span> ر.س </span>

                                                                </del>
                                                                <ins>
                                                                    {{$product['price'] - $product['discount']}}  <span> ر.س </span>
                                                                </ins>
                                                            </div>
                                                        @else
                                                            <div class="price">

                                                                <ins dir="rtl">
                                                                    {{$product['price']}} <span> ر.س </span>
                                                                </ins>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stelina-iconbox-wrapp default">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="stelina-iconbox  default">
                                <div class="iconbox-inner">
                                    <div class="icon-item">
                                        <span class="icon flaticon-rocket-ship"></span>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            شحن مجاني
                                        </h4>
                                        <div class="text">
                                            توصيل مجاني لجميع الطلبات <br/>التي يزيد سعرها عن 90.00 ر.س
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="stelina-iconbox  default">
                                <div class="iconbox-inner">
                                    <div class="icon-item">
                                        <span class="icon flaticon-return"></span>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            ضمان الاسترجاع
                                        </h4>
                                        <div class="text">
                                            ضمان استرداد الأموال لمدة 30 يومًا <br/>بدون طرح أي سؤال!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="stelina-iconbox  default">
                                <div class="iconbox-inner">
                                    <div class="icon-item">
                                        <span class="icon flaticon-padlock"></span>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            الدعم 24/7
                                        </h4>
                                        <div class="text">
                                            نحن هنا لدعمك. <br/>دعونا نتسوق الآن!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
