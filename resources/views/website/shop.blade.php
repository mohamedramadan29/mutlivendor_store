@extends('website.layouts.master')
@section('title')  المتجر   @endsection
@section('content')

    <div class="main-content main-content-product no-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{url('/')}}">الرئيسيه </a>
                            </li>
                            <li class="trail-item trail-end active">
                                المتجر
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content-area shop-grid-content full-width col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="site-main">

                        <div class="shop-top-control">
                            <form class="filter-choice select-form" name="sortProducts" id="sortProducts">
                                <span class="title"> ترتيب حسب </span>
                                <select name="sort" title="sort-by" data-placeholder="Price: Low to High" id="sort" class="chosen-select">
                                    <option value="" selected> رتب حسب  </option>
                                    <option @if(isset($_GET['sort']) && $_GET['sort'] == 'price_from_low_heigh') selected @endif value="price_from_low_heigh"> السعر : من الاقل الي الاعلي </option>
                                    <option @if(isset($_GET['sort']) && $_GET['sort'] == 'price_from_hieght_low') selected @endif value="price_from_hieght_low"> السعر : من الاعلي الي الاقل </option>
                                    <option @if(isset($_GET['sort']) && $_GET['sort'] == 'oldest') selected @endif value="oldest"> رتب حسب  الاقدم  </option>
                                    <option @if(isset($_GET['sort']) && $_GET['sort'] == 'latest') selected @endif value="latest">رتب حسب الاحدث </option>
                                </select>
                            </form>
                        </div>
                        <ul class="row list-products auto-clear equal-container product-grid">
                            @foreach($products as $product)

                                <li class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-12 style-1">
                                    <div class="product-inner equal-element">
                                        <div class="product-top">
                                            {{--                                        <div class="flash">--}}
                                            {{--										<span class="onnew">--}}
                                            {{--											<span class="text">--}}
                                            {{--												new--}}
                                            {{--											</span>--}}
                                            {{--										</span>--}}
                                            {{--                                        </div>--}}
                                        </div>
                                        <div class="product-thumb">
                                            <div class="thumb-inner">
                                                <a href=""{{url('product_details/'.$product['slug'])}}"">
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
                                                <a href="{{url('product_details/'.$product['slug'])}}">{{$product['name']}}</a>
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
                        {{-- Default paginaition  --}}

                        {{--                    @if(isset($_GET['sort']))--}}
                        {{--                        {{$products->appends(['sort'=>$_GET['sort']])->links()}}--}}
                        {{--                    @else--}}
                        {{--                        {{$products->links()}}--}}
                        {{--                    @endif--}}

                        @if ($products->lastPage() > 1)
                            <div class="pagination clearfix style2">
                                <div class="nav-link">
                                    @if ($products->onFirstPage())
                                        <a href="#" class="page-numbers"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{ $products->previousPageUrl() . (request()->has('sort') ? '&sort=' . request()->sort : '') }}" class="page-numbers"><i class="icon fa fa-angle-right" aria-hidden="true"></i></a>
                                    @endif

                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <a href="{{ $products->url($i) . (request()->has('sort') ? '&sort=' . request()->sort : '') }}" class="page-numbers @if ($i === $products->currentPage()) current @endif">{{ $i }}</a>
                                    @endfor

                                    @if ($products->hasMorePages())
                                        <a href="{{ $products->nextPageUrl() . (request()->has('sort') ? '&sort=' . request()->sort : '') }}" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
                                    @else
                                        <a href="#" class="page-numbers"><i class="icon fa fa-angle-left" aria-hidden="true"></i></a>
                                    @endif
                                </div>
                            </div>
                        @endif


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
