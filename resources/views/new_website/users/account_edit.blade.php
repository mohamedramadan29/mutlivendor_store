@extends('new_website.layouts.master')
@section('title')
    تفاصيل الحساب
@endsection

@section('content')

<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container" dir="rtl">
        <h2 class="page-title"> تفاصيل الحساب  </h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="{{url('user/profile')}}" class="menu-link menu-link_us-s"> الرئيسية  </a></li>
                    <li><a href="{{url('orders/index')}}" class="menu-link menu-link_us-s"> طلباتي  </a></li>
                    <li><a href="{{url('user/edit')}}" class="menu-link menu-link_us-s menu-link_active"> تفاصيل الحساب  </a></li>
                    <li><a href="account_wishlist.php" class="menu-link menu-link_us-s"> المفضلة  </a></li>
                    <li><a href="{{url('user/logout')}}" class="menu-link menu-link_us-s"> تسجيل خروج  </a></li>
                </ul>
            </div>
            <div class="col-lg-9">
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
                <div class="page-content my-account__edit">
                    <div class="my-account__edit-form">
                        <form name="account_edit_form" class="needs-validation" novalidate method="post" action="{{url('user/profile')}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="hidden" name="user_id" value="{{$user['id']}}">
                                        <input type="text" class="form-control" id="account_first_name" placeholder="الاسم " name="name" required value="{{$user['name']}}">
                                        <label for="account_first_name"> الاسم  </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" id="account_email" name="email" placeholder="البريد الالكتروني " required value="{{$user['email']}}">
                                        <label for="account_email">البريد الالكتروني </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="رقم الهاتف " required value="{{$user['mobile']}}">
                                        <label for="mobile"> رقم الهاتف  </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="العنوان" required value="{{$user['address']}}">
                                        <label for="address"> العنوان </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="المدينة " required value="{{$user['city']}}">
                                        <label for="city"> المدينة  </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="الولاية " required value="{{$user['state']}}">
                                        <label for="state"> الولاية  </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="country" name="country" placeholder="الدولة " required value="{{$user['country']}}">
                                        <label for="country"> الدولة  </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" id="pincode" name="pincode" placeholder="الرمز البريدي  "required value="{{$user['pincode']}}">
                                        <label for="country"> الرمز البريدي  </label>
                                    </div>
                                </div>
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="my-3">--}}
{{--                                        <h5 class="text-uppercase mb-0">Password Change</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-floating my-3">--}}
{{--                                        <input type="password" class="form-control" id="account_current_password" placeholder="Current password" required>--}}
{{--                                        <label for="account_current_password">Current password</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-floating my-3">--}}
{{--                                        <input type="password" class="form-control" id="account_new_password" placeholder="New password" required>--}}
{{--                                        <label for="account_new_password">New password</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-floating my-3">--}}
{{--                                        <input type="password" class="form-control" data-cf-pwd="#account_new_password" id="account_confirm_password" placeholder="Confirm new password" required>--}}
{{--                                        <label for="account_confirm_password">Confirm new password</label>--}}
{{--                                        <div class="invalid-feedback">Passwords did not match!</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <button class="btn btn-primary"> حفظ التغيرات  </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>
@endsection
