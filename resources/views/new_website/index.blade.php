@extends('new_website.layouts.master')
@section('title')
    الرئيسية
@endsection
@section('content')
    <main>
        <section dir="rtl" class="swiper-container js-swiper-slider slideshow type4 slideshow-navigation-white-sm"
                 data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "navigation": {
          "nextEl": ".slideshow__next",
          "prevEl": ".slideshow__prev"
        },
        "pagination": false,
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
            <div class="swiper-wrapper hero_section">
                @foreach($banners as $banner)
                    <div class="swiper-slide">
                        <div class="overflow-hidden position-relative h-100">
                            <div class="slideshow-bg">
                                <img loading="lazy" src="{{\Illuminate\Support\Facades\Storage::url($banner->image)}}"
                                     width="1920" height="600" alt="Pattern" class="slideshow-bg__img object-fit-cover">
                            </div>
                            <div class="slideshow-text container position-absolute top-50 translate-middle" style="left: 50%">
                                <h2 class="fs-70 mb-2 mb-lg-3 animate animate_fade animate_btt animate_delay-5 text-uppercase fw-normal">  {{$banner['sub_title']}} </h2>
                                <p class="h6 mb-4 pb-2 animate animate_fade animate_btt animate_delay-5 lh-2rem">  {{$banner['title']}} </p>
                                <div class="animate animate_fade animate_btt animate_delay-7">
                                    <a href="{{$banner['link']}}"
                                       class="btn btn-primary border-0 fs-base text-uppercase fw-normal btn-50">
                                        <span> مشاهدة المزيد  </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.slideshow-item -->
                @endforeach

            </div><!-- /.slideshow-wrapper js-swiper-slider -->

            <div
                class="slideshow__prev position-absolute top-50 d-flex align-items-center justify-content-center border-radius-0">
                <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_prev_sm"/>
                </svg>
            </div><!-- /.slideshow__prev -->
            <div
                class="slideshow__next position-absolute top-50 d-flex align-items-center justify-content-center border-radius-0">
                <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_next_sm"/>
                </svg>
            </div><!-- /.slideshow__next -->
        </section><!-- /.slideshow -->

        <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>
        <div class="text-center">
            @if(Session::has('Success_message'))
                <div
                    class="alert alert-success"> {{Session::get('Success_message')}} <a
                        href="{{url('cart/show')}}" style="color: red"> مشاهده السله </a></div>
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
        </div>
        <section class="products-carousel container">
            <h2 class="section-title text-uppercase fs-25 fw-medium text-center mb-2"> عروضنا </h2>
            <p class="fs-15 mb-4 pb-xl-2 mb-xl-4 text-secondary text-center"> احصل علي افضل العروض والخصومات </p>

            <div class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": false,
            "navigation": {
              "nextEl": ".products-carousel__next",
              "prevEl": ".products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 1,
                "spaceBetween": 30,
                "pagination": false
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach($offer_products as $product)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{url('product_details/'.$product['slug'])}}">
                                        <img loading="lazy" src="{{Storage::url($product['image'])}}" width="330"
                                             height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                                    </a>
                                    <form action="{{url('cart/add')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product['id']}}">
                                        <div class="product-single__addtocart">
                                            <div class="qty-control position-relative">
                                                <input type="number" name="qty" value="1" min="1"
                                                       class="qty-control__number text-center">
                                                <div class="qty-control__reduce">-</div>
                                                <div class="qty-control__increase">+</div>
                                            </div><!-- .qty-control -->
                                            <button type="submit"
                                                    class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart"
                                                    data-aside="cartDrawer" title="Add To Cart">  اضف الي السلة
                                            </button>
                                        </div>
                                    </form>

                                    <div class="anim_appear-right position-absolute top-0 mt-3 me-3">
                                        <button
                                            class="btn btn-square btn-hover-primary d-block border-1 text-uppercase mb-2 js-add-wishlist"
                                            title="Add To Wishlist">
                                            <svg width="14" height="14" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart"></use>
                                            </svg>
                                        </button>
{{--                                        <button--}}
{{--                                            class="btn btn-square btn-hover-primary d-block border-1 text-uppercase js-quick-view"--}}
{{--                                            data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">--}}
{{--                                            <svg class="d-inline-block" width="14" height="14" viewBox="0 0 18 18"--}}
{{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                <use href="#icon_view"></use>--}}
{{--                                            </svg>--}}
{{--                                        </button>--}}
                                    </div>
                                </div>

                                <div class="pc__info position-relative text-center">
                                    <p class="pc__category text-secondary"><a
                                            href="{{url('product_details/'.$product['slug'])}}">  {{$product['name']}}  </a>
                                    </p>
                                    <div
                                        class="product-card__price d-flex align-items-center justify-content-center mb-2">
                                        <span dir="rtl" class="money price fw-medium">  {{$product['price']}} ر.س </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md"/>
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md"/>
                    </svg>
                </div><!-- /.products-carousel__next -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->

        <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

        <section class="category-carousel main_categories"
                 style="background-image: url('{{asset('assets/new_website/images/background.png')}}');background-size:cover;background-position:center;">
            <div class="container">


                <h2 class="section-title text-uppercase fs-25 fw-medium text-center mb-2"> افضل الاقسام  </h2>
                <p class="fs-15 mb-4 pb-xl-2 mb-xl-4  text-center"> تصفح افضل اقسام العطور  </p>

                <div class="position-relative">
                    <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": false,
            "navigation": false,
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 1,
                "spaceBetween": 30,
                "pagination": false
              }
            }
          }'>
                        <div class="swiper-wrapper">
                            @foreach($categories as $category)
                                <div class="swiper-slide">
                                    <img loading="lazy" class="w-100 mb-3"
                                         src="{{\Illuminate\Support\Facades\Storage::url($category['image'])}}" width="330"
                                         height="400" alt="">
                                    <div class="text-center">
                                        <a href="{{url("category/".$category['slug'])}}" class="menu-link h6 fw-medium text-uppercase"> {{$category['name']}} </a>
                                    </div>
                                </div>
                            @endforeach

                        </div><!-- /.swiper-wrapper -->
                    </div><!-- /.swiper-container js-swiper-slider -->
                </div><!-- /.position-relative -->
            </div>
        </section><!-- /.products-carousel container -->

        <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

        <section class="products-carousel container">
            <h2 class="section-title text-uppercase fs-25 fw-medium text-center mb-2"> احصل علي افضل المنتجات  </h2>
            <p class="fs-15 mb-2 pb-xl-2 text-secondary text-center">   خلافاَ للإعتقاد السائد فإن لوريم إيبسوم ليس نصاَ عشوائياً، </p>


            <div class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": false,
            "navigation": {
              "nextEl": ".products-carousel__next",
              "prevEl": ".products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 1,
                "spaceBetween": 30,
                "pagination": false
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach($new_products as $product)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{url('product_details/'.$product['slug'])}}">
                                        <img loading="lazy" src="{{Storage::url($product['image'])}}" width="330"
                                             height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                                    </a>
                                    <form action="{{url('cart/add')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{$product['id']}}">
                                        <div class="product-single__addtocart">
                                            <div class="qty-control position-relative">
                                                <input type="number" name="qty" value="1" min="1"
                                                       class="qty-control__number text-center">
                                                <div class="qty-control__reduce">-</div>
                                                <div class="qty-control__increase">+</div>
                                            </div><!-- .qty-control -->
                                            <button type="submit"
                                                    class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart"
                                                    data-aside="cartDrawer" title="Add To Cart">  اضف الي السلة
                                            </button>
                                        </div>
                                    </form>

                                    <div class="anim_appear-right position-absolute top-0 mt-3 me-3">
                                        <button
                                            class="btn btn-square btn-hover-primary d-block border-1 text-uppercase mb-2 js-add-wishlist"
                                            title="Add To Wishlist">
                                            <svg width="14" height="14" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart"></use>
                                            </svg>
                                        </button>
                                        {{--                                        <button--}}
                                        {{--                                            class="btn btn-square btn-hover-primary d-block border-1 text-uppercase js-quick-view"--}}
                                        {{--                                            data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">--}}
                                        {{--                                            <svg class="d-inline-block" width="14" height="14" viewBox="0 0 18 18"--}}
                                        {{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
                                        {{--                                                <use href="#icon_view"></use>--}}
                                        {{--                                            </svg>--}}
                                        {{--                                        </button>--}}
                                    </div>
                                </div>

                                <div class="pc__info position-relative text-center">
                                    <p class="pc__category text-secondary"><a
                                            href="{{url('product_details/'.$product['slug'])}}">  {{$product['name']}}  </a>
                                    </p>
                                    <div
                                        class="product-card__price d-flex align-items-center justify-content-center mb-2">
                                        <span dir="rtl" class="money price fw-medium">  {{$product['price']}} ر.س </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md"/>
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md"/>
                    </svg>
                </div><!-- /.products-carousel__next -->
            </div><!-- /.position-relative -->


        </section>

        <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>

        <section class="lookbook-products container">
            <div class="position-relative">
                <img loading="lazy" src="{{asset('assets/new_website/images/home/demo15/banner-1.jpg')}}"
                     class="w-100 h-auto" width="1410" height="600" alt="">
                <div class="content d-none d-lg-block text-center py-5 px-5 bg-white position-absolute position-center">
                    <h3 class="fs-22 fw-medium text-uppercase mb-2">Bring Out The Hidden Beauty</h3>
                    <p class="fs-15 color-gray-5a5a5a mb-2">Get styled with the high-fashion products and transform
                        yourself.</p>
                    <a href="shop.php" class="btn-link btn-link_md default-underline text-uppercase fw-medium">Shop
                        Now</a>
                </div>
                <button class="popover-point type3 position-absolute" style="left: 6%; top: 23%;"
                        data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="
            <div class=&quot;popover-product&quot;>
              <a href=_/product1_simple.php>
                <img loading=&quot;lazy&quot; class=&quot;mb-3&quot; src=_/images/home/demo15/product-4.php alt=&quot;&quot; />
              </a>
              <p class=&quot;fw-medium mb-0&quot;><a href=_/product1_simple.php>RISE & SHINE</a></p>
              <p class=&quot;mb-0&quot;>$129</p>
            </div>
          " data-bs-original-title="" title=""><span>+</span></button>
                <button class="popover-point type3 position-absolute" style="left: 15%; top: 61%;"
                        data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="
            <div class=&quot;popover-product&quot;>
              <a href=_/product1_simple.php>
                <img loading=&quot;lazy&quot; class=&quot;mb-3&quot; src=_/images/home/demo15/product-4.php alt=&quot;&quot; />
              </a>
              <p class=&quot;fw-medium mb-0&quot;><a href=_/product1_simple.php>RISE & SHINE</a></p>
              <p class=&quot;mb-0&quot;>$129</p>
            </div>
          " data-bs-original-title="" title=""><span>+</span></button>
                <button class="popover-point type3 position-absolute" style="left: 37%; top: 83%;"
                        data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="
            <div class=&quot;popover-product&quot;>
              <a href=_/product1_simple.php>
                <img loading=&quot;lazy&quot; class=&quot;mb-3&quot; src=_/images/home/demo15/product-4.php alt=&quot;&quot; />
              </a>
              <p class=&quot;fw-medium mb-0&quot;><a href=_/product1_simple.php>RISE & SHINE</a></p>
              <p class=&quot;mb-0&quot;>$129</p>
            </div>
          " data-bs-original-title="" title=""><span>+</span></button>
            </div>
        </section>

        <div class="mb-3 mb-xl-5 pb-3 pt-1 pb-xl-5"></div>


        <div class="mb-3 mb-xl-4 pb-3 pt-1 pb-xl-4"></div>

        <section class="brands-carousel brands"
                 style="background-image:url('{{asset('assets/new_website/images/background.png')}}'); background-size:cover;background-postion:center;">
            <div class="container">
                <h2 class="d-none">Brands</h2>
                <div class="position-relative">
                    <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 7,
            "slidesPerGroup": 7,
            "effect": "none",
            "loop": true,
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 7,
                "slidesPerGroup": 1,
                "spaceBetween": 30,
                "pagination": false
              }
            }
          }'>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand1.png')}}"
                                     width="120" height="20" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand2.png')}}"
                                     width="87" height="20" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand3.png')}}"
                                     width="132" height="22" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand4.png')}}"
                                     width="72" height="21" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand5.png')}}"
                                     width="123" height="31" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand6.png')}}"
                                     width="137" height="22" alt="">
                            </div>
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{asset('assets/new_website/images/brands/brand7.png')}}"
                                     width="94" height="21" alt="">
                            </div>
                        </div>
                        <!-- /.swiper-wrapper -->
                    </div><!-- /.swiper-container js-swiper-slider -->
                </div><!-- /.position-relative -->
            </div>
        </section><!-- /.brands-carousel container -->

        <div class="mb-3 mb-xl-4 pb-3 pt-1 pb-xl-4"></div>

        <section class="instagram px-0 position-relative">
            <h2 class="d-none">Instagram</h2>
            <div class="row row-cols-2 row-cols-md-4 row-cols-xl-8 m-0">
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image682.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image683.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image684.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image685.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image686.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image687.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image682.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
                <div class="instagram__tile p-0">
                    <a href="https://instagram.com/" target="_blank"
                       class="position-relative overflow-hidden d-block effect overlay-plus">
                        <img loading="lazy" class="instagram__img"
                             src="{{asset('assets/new_website/images/image684.png')}}" width="240"
                             height="230" alt="">
                    </a>
                </div>
            </div>
            <button class="btn position-absolute position-center fw-medium px-4 d-flex align-items-center gap-2">
                <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.125 3.2959C5.375 3.2959 3.98047 4.71777 3.98047 6.44043C3.98047 8.19043 5.375 9.58496 7.125 9.58496C8.84766 9.58496 10.2695 8.19043 10.2695 6.44043C10.2695 4.71777 8.84766 3.2959 7.125 3.2959ZM7.125 8.49121C6.00391 8.49121 5.07422 7.58887 5.07422 6.44043C5.07422 5.31934 5.97656 4.41699 7.125 4.41699C8.24609 4.41699 9.14844 5.31934 9.14844 6.44043C9.14844 7.58887 8.24609 8.49121 7.125 8.49121ZM11.1172 3.18652C11.1172 2.77637 10.7891 2.44824 10.3789 2.44824C9.96875 2.44824 9.64062 2.77637 9.64062 3.18652C9.64062 3.59668 9.96875 3.9248 10.3789 3.9248C10.7891 3.9248 11.1172 3.59668 11.1172 3.18652ZM13.1953 3.9248C13.1406 2.94043 12.9219 2.06543 12.2109 1.35449C11.5 0.643555 10.625 0.424805 9.64062 0.370117C8.62891 0.31543 5.59375 0.31543 4.58203 0.370117C3.59766 0.424805 2.75 0.643555 2.01172 1.35449C1.30078 2.06543 1.08203 2.94043 1.02734 3.9248C0.972656 4.93652 0.972656 7.97168 1.02734 8.9834C1.08203 9.96777 1.30078 10.8154 2.01172 11.5537C2.75 12.2646 3.59766 12.4834 4.58203 12.5381C5.59375 12.5928 8.62891 12.5928 9.64062 12.5381C10.625 12.4834 11.5 12.2646 12.2109 11.5537C12.9219 10.8154 13.1406 9.96777 13.1953 8.9834C13.25 7.97168 13.25 4.93652 13.1953 3.9248ZM11.8828 10.0498C11.6914 10.5967 11.2539 11.0068 10.7344 11.2256C9.91406 11.5537 8 11.4717 7.125 11.4717C6.22266 11.4717 4.30859 11.5537 3.51562 11.2256C2.96875 11.0068 2.55859 10.5967 2.33984 10.0498C2.01172 9.25684 2.09375 7.34277 2.09375 6.44043C2.09375 5.56543 2.01172 3.65137 2.33984 2.83105C2.55859 2.31152 2.96875 1.90137 3.51562 1.68262C4.30859 1.35449 6.22266 1.43652 7.125 1.43652C8 1.43652 9.91406 1.35449 10.7344 1.68262C11.2539 1.87402 11.6641 2.31152 11.8828 2.83105C12.2109 3.65137 12.1289 5.56543 12.1289 6.44043C12.1289 7.34277 12.2109 9.25684 11.8828 10.0498Z"></path>
                </svg>
                <span>INSTAGRAM</span>
            </button>
        </section><!-- /.instagram container -->
    </main>
@endsection
