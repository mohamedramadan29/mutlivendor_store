@extends('new_website.layouts.master')
@section('title')
    حسابي
@endsection
@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container" dir="rtl">
        <h2 class="page-title"> حسابي  </h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="{{url('user/profile')}}" class="menu-link menu-link_us-s menu-link_active"> حسابي </a></li>
                    <li><a href="{{url('orders/index')}}" class="menu-link menu-link_us-s">طلباتي </a></li>
                    <li><a href="{{url('user/edit')}}" class="menu-link menu-link_us-s"> تفاصيل الحساب  </a></li>
                    <li><a href="account_wishlist.php" class="menu-link menu-link_us-s"> المفضلة  </a></li>
                    <li><a href="{{url('user/logout')}}" class="menu-link menu-link_us-s"> تسجيل خروج  </a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="page-content my-account__dashboard">
                    <p>مرحبا  <strong>{{Auth::user()->name}}</strong> (لست  <strong> {{Auth::user()->name}} ?</strong> <a href="{{url('user/logout')}}">تسجيل خروج</a>)</p>
                    <p>  من لوحة التحكم بحسابك، يمكنك عرض طلباتك الأخيرة، وإدارة عناوين الشحن والفوترة، وتعديل كلمة المرور وتفاصيل الحساب. </p>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>

@endsection

