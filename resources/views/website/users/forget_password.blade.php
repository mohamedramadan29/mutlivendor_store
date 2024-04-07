@extends('website.layouts.master')
@section('title')
    تسجيل دخول / حساب جديد للمستخدم
@endsection
@section('content')
    <div>
        <div class="main-content main-content-login">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items breadcrumb">
                                <li class="trail-item trail-begin">
                                    <a href="{{url('/')}}"> الرئيسيه </a>
                                </li>
                                <li class="trail-item trail-end active">
                                    نسيت كلمه المرور
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="site-main">
                            <h3 class="custom_blog_title">
                                نسيت كلمه المرور
                            </h3>
                            <div class="customer_login">
                                <div class="row">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="login-item">

                                            <form class="login" action="{{url('user/forget_password')}}" method="post">
                                                @csrf
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> البريد الالكتروني </label>
                                                    <input title="البريد الالكتروني " type="email" class="input-text"
                                                           name="email" value="{{old('email')}}">
                                                </p>
                                                <p class="lost_password">
                                                    <br>
                                                    <a href="{{url('user/login_register')}}" class="forgot-pw"> تسجيل دخول ؟ </a>
                                                    <br>
                                                </p>
                                                <p class="form-row">
                                                    <input type="submit" class="button-submit" value=" ارسال  ">
                                                </p>
                                            </form>
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
