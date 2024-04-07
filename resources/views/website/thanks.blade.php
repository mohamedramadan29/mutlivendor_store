@extends('website.layouts.master')
@section('title')
    تم الطلب بنجاح
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
                                تم الطلب بنجاح
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3 class="custom_blog_title">
                تم الطلب بنجاح
            </h3>
            <div class="checkout-wrapp">
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
                        <a href="{{url('user/profile')}}" class="button btn-return">  حسابي </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
