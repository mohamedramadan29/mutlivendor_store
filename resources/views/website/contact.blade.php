@extends('website.layouts.master')
@section('title')
    تواصل معنا
@endsection
@section('content')

    <div class="main-content main-content-contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{url('/')}}">الرئيسيه </a>
                            </li>
                            <li class="trail-item trail-end active">
                                تواصل معنا
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content-area content-contact col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="site-main">
                        <h3 class="custom_blog_title"> تواصل معنا </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-main-content">
            <div class="google-map">
                <iframe width="100%" height="500" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-contact">
                            <div class="col-lg-8 no-padding">
                                <div class="form-message">
                                    @if(Session::has('Success_message'))
                                        <div
                                            class="alert alert-success"> {{Session::get('Success_message')}}  </div>
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
                                    <h2 class="title">
                                        ارسل لنا رسالتك !
                                    </h2>
                                    <form action="{{url('contact')}}" class="stelina-contact-fom" method="post" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>
                                                    <span class="form-label">الاسم *</span>
                                                    <span class="form-control-wrap your-name">
                                                    <input required title="your-name" type="text" name="name" size="40"
                                                           class="form-control form-control-name" value="{{old('name')}}">
                                                </span>
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>
                                                <span class="form-label">
                                                    البريد الالكتروني *
                                                </span>
                                                    <span class="form-control-wrap your-email">
                                                    <input title="your-email" type="email" name="email" size="40"
                                                           class="form-control form-control-email" value="{{old('email')}}">
                                                </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>
                                                    <span class="form-label"> رقم الهاتف </span>
                                                    <span class="form-control-wrap your-phone">
                                                    <input required title="your-phone" type="text" name="phone"
                                                           class="form-control form-control-phone" value="{{old('phone')}}">
                                                </span>
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p>
                                                <span class="form-label">
                                                    عنوان الرساله
                                                </span>
                                                    <span class="form-control-wrap your-company">
                                                    <input required title="your-company" type="text" name="subject"
                                                           class="form-control your-company" value="{{old('subject')}}">
                                                </span>
                                                </p>
                                            </div>
                                        </div>
                                        <p>
                                        <span class="form-label">
                                            رسالتك
                                        </span>
                                            <span class="wpcf7-form-control-wrap your-message">
                                            <textarea required title="your-message" name="message" cols="40" rows="9"
                                                      class="form-control your-textarea">{{old('message')}}</textarea>
                                        </span>
                                        </p>
                                        <p>
                                            <input type="submit" value="ارسال"
                                                   class="form-control-submit button-submit">
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 no-padding">
                                <div class="form-contact-information">
                                    <form action="#" class="stelina-contact-info">
                                        <h2 class="title">
                                            معلومات التواصل
                                        </h2>
                                        <div class="info">
                                            <div class="item phone">
                                            <span class="icon">
                                            </span>
                                                <span class="text">
                                                (+800) 0000000000999
                                            </span>
                                            </div>
                                            <div class="item email">
                                            <span class="icon">
                                            </span>
                                                <span class="text">
                                                info@gmail.com
                                            </span>
                                            </div>
                                        </div>
                                        <div class="socials">
                                            <a href="#" class="social-item" target="_blank">
                                            <span class="icon fa fa-facebook">

                                            </span>
                                            </a>
                                            <a href="#" class="social-item" target="_blank">
                                            <span class="icon fa fa-twitter-square">

                                            </span>
                                            </a>
                                            <a href="#" class="social-item" target="_blank">
                                            <span class="icon fa fa-instagram">

                                            </span>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
