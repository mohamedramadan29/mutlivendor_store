<?php
$categories = \App\Models\admin\Category::all();
$sections = \App\Models\Admin\Section::with('categories')->get();
//dd($sections);
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
                        <a href="{{url('vendor/login_register')}}"> تسجيل دخول / حساب جديد </a>
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
                            <a href="javascript:void(0);" class="shopcart-icon" data-stelina="stelina-dropdown">
                                Cart
                                <span class="count">
                                    0
                                </span>
                            </a>
                            <div class="shopcart-description stelina-submenu">
                                <div class="content-wrap">
                                    <h3 class="title"> سلة المشتريات </h3>
                                    <ul class="minicart-items">
                                        <li class="product-cart mini_cart_item">
                                            <a href="#" class="product-media">
                                                <img src="{{asset('assets/website/images/item-minicart-1.jpg')}}"
                                                     alt="img">
                                            </a>
                                            <div class="product-details">
                                                <h5 class="product-name">
                                                    <a href="#">Bibliotheque</a>
                                                </h5>
                                                <div class="variations">
                                                    <span class="attribute_color">
                                                        <a href="#">Black</a>
                                                    </span>
                                                    ,
                                                    <span class="attribute_size">
                                                        <a href="#">300ml</a>
                                                    </span>
                                                </div>
                                                <span class="product-price">
                                                    <span class="price">
                                                        <span> ر.س 45</span>
                                                    </span>
                                                </span>
                                                <span class="product-quantity">
                                                    (x1)
                                                </span>
                                                <div class="product-remove">
                                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-cart mini_cart_item">
                                            <a href="#" class="product-media">
                                                <img src="{{asset('assets/website/images/item-minicart-2.jpg')}}"
                                                     alt="img">
                                            </a>
                                            <div class="product-details">
                                                <h5 class="product-name">
                                                    <a href="#">Soap Dining Solutions</a>
                                                </h5>
                                                <div class="variations">
                                                    <span class="attribute_color">
                                                        <a href="#">Black</a>
                                                    </span>
                                                    ,
                                                    <span class="attribute_size">
                                                        <a href="#">300ml</a>
                                                    </span>
                                                </div>
                                                <span class="product-price">
                                                    <span class="price">
                                                        <span> ر.س 45</span>
                                                    </span>
                                                </span>
                                                <span class="product-quantity">
                                                    (x1)
                                                </span>
                                                <div class="product-remove">
                                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-cart mini_cart_item">
                                            <a href="#" class="product-media">
                                                <img src="{{asset('assets/website/images/item-minicart-3.jpg')}}"
                                                     alt="img">
                                            </a>
                                            <div class="product-details">
                                                <h5 class="product-name">
                                                    <a href="#">Dining Solutions Soap</a>
                                                </h5>
                                                <div class="variations">
                                                    <span class="attribute_color">
                                                        <a href="#">Black</a>
                                                    </span>
                                                    ,
                                                    <span class="attribute_size">
                                                        <a href="#">300ml</a>
                                                    </span>
                                                </div>
                                                <span class="product-price">
                                                    <span class="price">
                                                        <span> ر.س 45</span>
                                                    </span>
                                                </span>
                                                <span class="product-quantity">
                                                    (x1)
                                                </span>
                                                <div class="product-remove">
                                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="subtotal">
                                        <span class="total-title"> المجموع الفرعي : </span>
                                        <span class="total-price">
                                            <span class="Price-amount">
                                                ر.س 135
                                            </span>
                                        </span>
                                    </div>
                                    <div class="actions">
                                        <a class="button button-viewcart" href="shoppingcart.php">
                                            <span> مشاهده السله </span>
                                        </a>
                                        <a href="checkout.php" class="button button-checkout">
                                            <span> اتمام الطلب </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-account block-header stelina-dropdown">
                            <a href="javascript:void(0);" data-stelina="stelina-dropdown">
                                <span class="flaticon-user"></span>
                            </a>
                            <div class="header-account stelina-submenu">
                                <div class="header-user-form-tabs">
                                    <ul class="tab-link">
                                        <li class="active">
                                            <a data-toggle="tab" aria-expanded="true" href="#header-tab-login"> تسجيل
                                                دخول </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" aria-expanded="true" href="#header-tab-rigister"> حساب
                                                جديد </a>
                                        </li>
                                    </ul>
                                    <div class="tab-container">
                                        <div id="header-tab-login" class="tab-panel active">
                                            <form method="post" class="login form-login">
                                                <p class="form-row form-row-wide">
                                                    <input type="email" placeholder="البريد الالكتروني"
                                                           class="input-text">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <input type="password" class="input-text" placeholder="كلمه المرور">
                                                </p>
                                                <p class="form-row">

                                                    <input type="submit" class="button" value="تسجيل دخول ">
                                                </p>
                                                <p class="lost_password">
                                                    <a href="#"> نسيت كلمه المرور ؟</a>
                                                </p>
                                            </form>
                                        </div>
                                        <div id="header-tab-rigister" class="tab-panel">
                                            <form method="post" class="register form-register">
                                                <p class="form-row form-row-wide">
                                                    <input type="email" placeholder="البريد الالكتروني"
                                                           class="input-text">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <input type="password" class="input-text" placeholder="كلمه المرور">
                                                </p>
                                                <p class="form-row">
                                                    <input type="submit" class="button" value="حساب جديد">
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <form class="form-search form-search-width-category">
                            <div class="form-content">
                                <div class="inner">
                                    <input type="text" class="input" name="s" value="" placeholder=" بحث ">
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
                        <a href="index.php">
                            <img src="{{asset('assets/website/images/new_logo.jpeg')}}" alt="img" width="35px">
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
                                <a href="index.php" class="stelina-menu-item-title" title="About"> الرئيسيه </a>
                            </li>
                            <li class="menu-item">
                                <a href="gridproducts.php" class="stelina-menu-item-title" title="About"> المتجر </a>
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
                                <a href="contact.php" class="stelina-menu-item-title" title="About"> تواصل معنا </a>
                            </li>
                            <li class="menu-item">
                                <a href="product_details.php" class="stelina-menu-item-title" title="About"> تفاصيل
                                    منتج </a>
                            </li>
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
