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
                                    حساب جديد / تسجيل دخول للمستخدم
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="site-main">
                            <h3 class="custom_blog_title">
                                حساب جديد / تسجيل دخول للمستخدم
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
                                            <h5 class="title-login">تسجيل دخول </h5>
                                            <form  class="login" action="{{url('user/login')}}" method="post">
                                                @csrf
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> البريد الالكتروني   </label>
                                                    <input title="البريد الالكتروني " type="email" class="input-text" name="email" value="{{old('email')}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> كلمه المرور </label>
                                                    <input title="كلمه المرور"  name="password" type="password" class="input-text">
                                                </p>
                                                <p class="lost_password">
											<span class="inline">
												<input type="checkbox" id="cb1">
												<label for="cb1" class="label-text"> تذكرني </label>
											</span>
                                                    <br>
                                                    <br>
                                                    <a href="{{url('user/forget_password')}}" class="forgot-pw"> نسيت كلمه المرور ؟ </a>
                                                    <br>
                                                </p>
                                                <p class="form-row">
                                                    <input type="submit" class="button-submit" value="تسجيل دخول">
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="login-item">
                                            <h5 class="title-login">حساب جديد</h5>
                                            <form class="register" id="user_register" method="post"
                                                  action="{{url('user/register')}}">
                                                @csrf
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> الاسم </label>
                                                    <input required title="name" name="name" type="text"
                                                           class="input-text" value="{{old('name')}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text">البريد الالكتروني </label>
                                                    <input required title="email" name="email" type="email"
                                                           class="input-text" value="{{old('email')}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> رقم الهاتف </label>
                                                    <input required title="mobile" name="mobile" type="text"
                                                           class="input-text" value="{{old('mobile')}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text">كلمه المرور </label>
                                                    <input required title="password" name="password" type="password"
                                                           class="input-text">
                                                </p>
                                                <p class="form-row">
											<span class="inline">
												<input type="checkbox" id="cb2" name="accept">
												<label for="cb2"
                                                       class="label-text"> اوافق علي <span>الشروط والاحكام </span></label>
											</span>
                                                </p>
                                                <p class="">
                                                    <input type="submit" class="button-submit" value="حساب جديد">
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
