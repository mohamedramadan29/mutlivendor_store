@extends('website.layouts.master')
@section('title') سله المشتريات  @endsection
@section('content')
    <div>

        <div class="site-content">
            <main class="site-main  main-container no-sidebar">
                <div class="container">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="#">
                            <span>
                                الرئيسيه
                            </span>
                                </a>
                            </li>
                            <li class="trail-item trail-end active">
                        <span>
                            سله المشتريات
                        </span>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="main-content-cart main-content col-sm-12">
                            <h3 class="custom_blog_title">
                                سله المشتريات
                            </h3>
                            <div class="page-main-content" >
                                <div class="shoppingcart-content" id="append_cart_items">
                                 @include('website.cart_items')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>


    </div>
@endsection
