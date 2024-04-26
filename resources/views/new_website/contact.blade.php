@extends('new_website.layouts.master')
@section('title')
     تواصل معنا
@endsection
@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
        <div class="mw-930">
            <h2 class="page-title">CONTACT US</h2>
        </div>
    </section>

    <section class="google-map mb-5">
        <h2 class="d-none">Contact US</h2>
        <div class="google-map__wrapper">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d475325.0270041315!2d39.540121379779!3d21.449801505087756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2z2KzYr9ipINin2YTYs9i52YjYr9mK2Kk!5e0!3m2!1sar!2seg!4v1714032455460!5m2!1sar!2seg" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section class="contact-us container">
        <div class="mw-930">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h3 class="mb-4">Store in London</h3>
                    <p class="mb-4">1418 River Drive, Suite 35 Cottonhall, CA 9622<br>United Kingdom</p>
                    <p class="mb-4">sale@uomo.com<br>+44 20 7123 4567</p>
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-4">Store in Istanbul</h3>
                    <p class="mb-4">1418 River Drive, Suite 35 Cottonhall, CA 9622<br>Turky</p>
                    <p class="mb-4">sale@uomo.com<br>+90 212 555 1212</p>
                </div>
            </div>
            <div class="contact-us__form">
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
                <form method="post" action="{{url('contact')}}" class="needs-validation" novalidate>
                    @csrf
                    <h3 class="mb-5">Get In Touch</h3>
                    <div class="form-floating my-4">
                        <input type="text" name="name" class="form-control" id="contact_us_name" placeholder="Name *" required value="{{old('name')}}">
                        <label for="contact_us_name">Name *</label>
                    </div>
                    <div class="form-floating my-4">
                        <input type="email" name="email" class="form-control" id="contact_us_email" placeholder="Email address *" required value="{{old('email')}}">
                        <label for="contact_us_name">Email address *</label>
                    </div>
                    <div class="form-floating my-4">
                        <input type="text" name="phone" class="form-control" id="contact_us_phone" placeholder="Phone *" required value="{{old('phone')}}">
                        <label for="contact_us_name">Phone *</label>
                    </div>
                    <div class="form-floating my-4">
                        <input type="text" name="subject" class="form-control" id="contact_us_phone" placeholder="subject *" value="{{old('subject')}}">
                        <label for="contact_us_name">subject *</label>
                    </div>
                    <div class="my-4">
                        <textarea class="form-control form-control_gray" name="message" placeholder="Your Message" cols="30" rows="8" required>{{old('message')}}</textarea>
                    </div>
                    <div class="my-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>

@endsection
