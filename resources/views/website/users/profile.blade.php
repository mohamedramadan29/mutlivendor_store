@extends('new_website.layouts.master')
@section('title')
    حسابي [vdv
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
                                    حسابي
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="content-area col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="site-main">
                            <h3 class="custom_blog_title">
                                حسابي
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
                                            <h5 class="title-login"> بيانات الحساب  </h5>
                                            <form  class="login" action="{{url('user/profile')}}" method="post">
                                                @csrf
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> البريد الالكتروني   </label>
                                                    <input disabled readonly style="background-color: #eee" title="البريد الالكتروني " type="email" class="input-text" name="email" value="{{Auth::user()->email}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> الاسم  </label>
                                                    <input title=" الاسم  " type="text" class="input-text" name="name" value="{{Auth::user()->name}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text"> العنوان   </label>
                                                    <input title=" العنوان " type="text" class="input-text" name="address" value="{{Auth::user()->address}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text">  المدينه  </label>
                                                    <input title=" المدينه " type="text" class="input-text" name="city" value="{{Auth::user()->city}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text">  الولايه   </label>
                                                    <input title="  الولايه   " type="text" class="input-text" name="state" value="{{Auth::user()->state}}">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label class="text">  الدوله  </label>
                                                    <input title="   الدوله   " type="text" class="input-text" name="country" value="{{Auth::user()->country}}">
                                                </p>

                                                <p class="form-row form-row-wide">
                                                    <label class="text">  الرمز البريدي   </label>
                                                    <input title=" الرمز البريدي " type="text" class="input-text" name="pincode" value="{{Auth::user()->pincode}}">
                                                </p>

                                                <p class="form-row form-row-wide">
                                                    <label class="text">   رقم الهاتف  </label>
                                                    <input title="   رقم الهاتف  " type="text" class="input-text" name="mobile" value="{{Auth::user()->mobile}}">
                                                </p>


                                                <p class="form-row">
                                                    <input type="submit" class="button-submit" value=" تعديل  ">
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="login-item">
                                                <h5 class="title-login"> تعديل كلمه المرور  </h5>
                                                <form  class="login" action="{{url('user/update_password')}}" method="post">
                                                    @csrf
                                                    <p class="form-row form-row-wide">
                                                        <label class="text"> كلمه المرور القديمه    </label>
                                                        <input title=" كلمه المرور القديمه  " type="password" class="input-text" name="old_password">
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        <label class="text">  كلمه المرور الجديده </label>
                                                        <input title=" كلمه المرور الجديده " type="password" class="input-text" name="new_password">
                                                    </p>
                                                    <p class="form-row form-row-wide">
                                                        <label class="text"> تاكيد كلمه المرور   </label>
                                                        <input title=" تاكيد كلمه المرور" type="password" class="input-text" name="confirm_password">
                                                    </p>
                                                    <p class="form-row">
                                                        <input type="submit" class="button-submit" value=" تعديل  ">
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
