@extends('new_website.layouts.master')
@section('title')
    نسيت كلمة المرور
@endsection
@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="login-register container">
        <h2 class="section-title text-center fs-3 "> تغير كلمة المرور  </h2>
        <p> سوف نرسل لك بريدًا إلكترونيًا لإعادة تعيين كلمة المرور الخاصة بك </p>
        <div class="reset-form">
            <form action="{{url('user/forget_password')}}" method="post" name="reset-form" class="needs-validation" novalidate>
                @csrf
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control form-control_gray" id="customerNameEmailInput" required value="{{old('email')}}">
                    <label for="customerNameEmailInput"> البريد الالكتروني  *</label>
                </div>

                <button class="btn btn-primary w-100 text-uppercase" type="submit"> ارسال  </button>

                <div class="customer-option mt-4 text-center">
                    <span class="text-secondary"> الرجوع الي :  </span>
                    <a href="{{url('user/login_register')}}" class="btn-text js-show-register"> تسجيل دخول  </a>
                </div>
            </form>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>

@endsection
