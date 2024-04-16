<?php
$categories = \App\Models\admin\Category::all();
$sections = \App\Models\Admin\Section::with('categories')->get();
?>
<header class="header style7">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-left">
                <div class="header-message">
                    مرحبا بك في متجرنا الالكتروني
                </div>
            </div>
            <div class="top-bar-right">
                <ul class="header-user-links">
                    <li>
                        <a href="{{url('vendor/login_register')}}"> تسجيل كتاجر </a>
                    </li>
                    <li>
                        <a href="{{url('user/login_register')}}"> تسجيل كمستخدم </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main-header">
            <div class="row">
                <div class="col-lg-2 col-sm-12 col-md-3 col-xs-12 col-ts-12">
                    <div class="header-control">
                        <div class="block-minicart stelina-mini-cart block-header stelina-dropdown">
                            <a href="{{url('cart/show')}}" class="shopcart-icon">
                                Cart
                                <span class="count">
                                    @php
                                        $Cart =  \App\Models\Cart::getcartitems();
                                       $cartCountItems = $Cart->count();
                                       echo $cartCountItems;
                                    @endphp
                                </span>
                            </a>
                        </div>
                        <div class="block-account block-header stelina-dropdown">
                            <a href="{{url('vendor/login_register')}}">
                                <span class="flaticon-user"></span>
                            </a>

                        </div>
                        <a class="menu-bar mobile-navigation menu-toggle" href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-8 col-md-6 col-xs-5 col-ts-12">
                    <div class="block-search-block">
                        <form class="form-search form-search-width-category" method="get" action="{{url('search-products')}}">
                            <div class="form-content">
                                <div class="inner">
                                    <input type="text" class="input" name="search" value="" placeholder=" بحث ">
                                </div>
                                <button class="btn-search" type="submit">
                                    <span class="icon-search"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-4 col-md-3 col-xs-7 col-ts-12 header-element">
                    <div class="logo">
                        <a href="{{url("/")}}">
                            <img src="{{asset('assets/website/images/logo.png')}}" alt="img" width="100px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-nav-container rows-space-20">
        <div class="container">
            <div class="header-nav-wapper main-menu-wapper">

                <div class="header-nav">
                    <div class="container-wapper">
                        <ul class="stelina-clone-mobile-menu stelina-nav main-menu " id="menu-main-menu">
                            <li class="menu-item">
                                <a href="{{url('/')}}" class="stelina-menu-item-title" title="About"> الرئيسيه </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('shop')}}" class="stelina-menu-item-title" title="About"> المتجر </a>
                            </li>
                            @foreach($categories as $category)

                                <li class="menu-item">
                                    <a href="{{url("category/".$category['slug'])}}" class="stelina-menu-item-title"
                                       title="About"> {{$category['name']}} </a>
                                </li>
                            @endforeach

                            {{--                            <li class="menu-item  menu-item-has-children">--}}
                            {{--                                <a href="inblog_right-siderbar.html" class="stelina-menu-item-title" title="الاقسام"> كل--}}
                            {{--                                    الاقسام </a>--}}
                            {{--                                <span class="toggle-submenu"></span>--}}
                            {{--                                <ul class="submenu">--}}
                            {{--                                    <li class="menu-item menu-item-has-children">--}}
                            {{--                                        <a href="#" class="stelina-menu-item-title" title="Blog Style">العطور </a>--}}
                            {{--                                        <span class="toggle-submenu"></span>--}}
                            {{--                                        <ul class="submenu">--}}
                            {{--                                            <li class="menu-item">--}}
                            {{--                                                <a href="#">معطرات الغرف </a>--}}
                            {{--                                            </li>--}}
                            {{--                                            <li class="menu-item">--}}
                            {{--                                                <a href="#">فوحات الكترونيه </a>--}}
                            {{--                                            </li>--}}
                            {{--                                        </ul>--}}
                            {{--                                    </li>--}}
                            {{--                                    <li class="menu-item">--}}
                            {{--                                        <a href="#"> عطور المنزل </a>--}}
                            {{--                                    </li>--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}
                            <li class="menu-item">
                                <a href="{{url('contact')}}" class="stelina-menu-item-title" title="About"> تواصل
                                    معنا </a>
                            </li>
                            @if(Auth::check())
                                <li>
                                    <a href="{{url('user/account')}}"> حسابي </a>
                                </li>
                                <li>
                                    <a href="{{url('orders/index')}}"> الطلبات   </a>
                                </li>
                                <li>
                                    <a href="{{url('user/logout')}}"> تسجيل خروج </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{url('vendor/login_register')}}"> تسجيل كتاجر </a>
                                </li>
                                <li>
                                    <a href="{{url('user/login_register')}}"> تسجيل كمستخدم </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="header-device-mobile">
    <div class="wapper">
        <div class="item mobile-logo">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('assets/website/images/new_logo.jpeg')}}" width="20px" alt="img">
                </a>
            </div>
        </div>
        <div class="item item mobile-search-box has-sub">
            <a href="#">
                <span class="icon">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
            </a>
            <div class="block-sub">
                <a href="#" class="close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <div class="header-searchform-box">
                    <form class="header-searchform">
                        <div class="searchform-wrap">
                            <input type="text" class="search-input" placeholder=" بحث ">
                            <input type="submit" class="submit button" value="بحث">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="item menu-bar">
            <a class=" mobile-navigation  menu-toggle" href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
</div>
