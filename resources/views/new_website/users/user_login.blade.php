@extends('new_website.layouts.master')
@section('title')
    تسجيل دخول / حساب جديد
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <h2 class="d-none"> تسجيل دخول & حساب جديد  </h2>
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab"
                       href="#tab-item-login" role="tab" aria-controls="tab-item-login" aria-selected="true"> تسجيل دخول  </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore" id="register-tab" data-bs-toggle="tab"
                       href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="false"> حساب جديد  </a>
                </li>
            </ul>
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
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
                    <div class="login-form">
                        <form name="login-form" class="needs-validation" novalidate  action="{{url('user/login')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input name="email" type="email" class="form-control form-control_gray"
                                       id="customerNameEmailInput1" placeholder="البريد الالكتروني  *" required value="{{old('email')}}">
                                <label for="customerNameEmailInput1"> البريد الالكتروني  *</label>
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control form-control_gray"
                                       id="customerPasswodInput" placeholder="كلمة المرور  *" required>
                                <label for="customerPasswodInput">كلمة المرور   *</label>
                            </div>

                            <div class="d-flex align-items-center mb-3 pb-2">
                                <div class="form-check mb-0">
                                    <input name="remember" class="form-check-input form-check-input_fill"
                                           type="checkbox" value="" id="flexCheckDefault1">
                                    <label class="form-check-label text-secondary" for="flexCheckDefault1"> تذكرني  </label>
                                </div>
                                <a href="{{url('user/forget_password')}}" class="btn-text ms-auto">نسيت كلمة المرور ?</a>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit"> تسجيل دخول  </button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">ليس لديك حساب ?</span>
                                <a href="#register-tab" class="btn-text js-show-register"> حساب جديد  </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
                    <div class="register-form">
                        <form name="register-form" class="needs-validation" novalidate action="{{url('user/register')}}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input name="name" type="text" class="form-control form-control_gray" value="{{old('name')}}"
                                       id="customerNameRegisterInput" placeholder="الاسم " required>
                                <label for="customerNameRegisterInput"> الاسم  </label>
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input name="email" type="email" class="form-control form-control_gray" value="{{old('email')}}"
                                       id="customerEmailRegisterInput" placeholder="البريد الالكتروني  *" required>
                                <label for="customerEmailRegisterInput">البريد الالكتروني  *</label>
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input name="mobile" type="text" class="form-control form-control_gray" value="{{old('mobile')}}"
                                       id="customerEmailRegisterInput" placeholder="رقم الهاتف  *" required>
                                <label for="customerEmailRegisterInput"> رقم الهاتف  *</label>
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input name="password" type="password" class="form-control form-control_gray"
                                       id="customerPasswodRegisterInput" placeholder="كلمة المرور *" required>
                                <label for="customerPasswodRegisterInput"> كلمة المرور  *</label>
                            </div>
                            <div class="d-flex align-items-center mb-3 pb-2">
                                <div class="form-check mb-0">
                                    <input name="accept" class="form-check-input form-check-input_fill"
                                           type="checkbox" value="" id="accept" checked>
                                    <label class="form-check-label text-secondary" for="accept"> اوافق علي الشروط والاحكام  </label>
                                </div>

                            </div>
                            <button class="btn btn-primary w-100 text-uppercase" type="submit"> حساب جديد  </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="mb-5 pb-xl-5"></div>
@endsection
