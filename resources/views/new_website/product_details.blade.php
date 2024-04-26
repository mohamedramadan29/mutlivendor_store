@extends('new_website.layouts.master')
@section('title')
    الرئيسية
@endsection
@section('content')
    <main>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        <img loading="lazy" class="h-auto" src="{{Storage::url($product->image)}}"
                                             width="674" height="674" alt="">
                                        <a data-fancybox="gallery" href="{{Storage::url($product->image)}}"
                                           data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_zoom"/>
                                            </svg>
                                        </a>
                                    </div>
                                    @if($product['productImages'] !=null)
                                        @foreach($product['productImages'] as $sub_image)
                                            <div class="swiper-slide product-single__image-item">
                                                <img loading="lazy" class="h-auto"
                                                     src="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                     width="674" height="674" alt="">
                                                <a data-fancybox="gallery"
                                                   href="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                   data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_zoom"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="swiper-button-prev">
                                    <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm"/>
                                    </svg>
                                </div>
                                <div class="swiper-button-next">
                                    <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                                                              class="h-auto"
                                                                                              src="{{Storage::url($product->image)}}"
                                                                                              width="104" height="104"
                                                                                              alt=""></div>
                                    @if($product['productImages'] !=null)
                                        @foreach($product['productImages'] as $sub_image)
                                            <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                                                                      class="h-auto"
                                                                                                      src="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                                                                      width="104"
                                                                                                      height="104"
                                                                                                      alt=""></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" dir="rtl">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="{{url('/')}}" class="menu-link menu-link_us-s text-uppercase fw-medium"> الرئيسية  </a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="{{url('category/'.$category_data['slug'])}}"
                               class="menu-link menu-link_us-s text-uppercase fw-medium"> {{$category_data['name']}} </a>
                        </div><!-- /.breadcrumb -->

                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">

                            <a href="{{url('category/'.$category_data['slug'])}}" class="text-uppercase fw-medium"><span
                                    class="menu-link menu-link_us-s"> مشاهدة المزيد من المنتجات   </span>
                                <svg class="mb-1px" width="10" height="10" viewBox="0 0 25 25"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_md"/>
                                </svg>
                            </a>
                        </div><!-- /.shop-acs -->
                    </div>
                    <h1 class="product-single__name">  {{$product['name']}}  </h1>

                    <div class="product-single__price">
                        <span class="current-price">  {{$product['price']}} ر.س   </span>
                    </div>
                    <div class="product-single__short-desc">
                        <p> {{$product['short_description']}} </p>
                    </div>
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
                            <button type="submit" class="btn btn-primary btn-addtocart"> اضافه
                                الي السله
                            </button>
                        </div>
                    </form>
{{--                    <div class="product-single__addtolinks">--}}
{{--                        <a href="#" class="menu-link menu-link_us-s add-to-wishlist">--}}
{{--                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <use href="#icon_heart"/>--}}
{{--                            </svg>--}}
{{--                            <span>Add to Wishlist</span></a>--}}
{{--                    </div>--}}
                    <div class="product-single__meta-info" dir="rtl">

                        <div class="meta-item">
                            <label> القسم  :</label>
                            <span> {{$category_data['name']}} </span>
                        </div>
                        @if($product['meta_keywords'] !='')
                            <div class="meta-item">
                                <label>Tags:</label>
                                <span> {{$product['meta_keywords']}} </span>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="product-single__details-tab" dir="rtl">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                           href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true"> الوصف  </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                           href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false"> اراء العملاء  </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                         aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <p>  {{$product['description']}} </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        @php $count_reviews = \App\Models\ProductReviews::where('product_id',$product['id'])->count();  @endphp
                        @if($count_reviews > 0)
                            <h2 class="product-single__reviews-title">Reviews</h2>
                        @endif
                        <div class="product-single__reviews-list">
                            @foreach($product_reviews as $review)
                                <div class="product-single__reviews-item">
                                    <div class="customer-avatar">
                                        <img loading="lazy" src="{{asset('assets/new_website/images/logo.png')}}"
                                             alt="magical-spray">
                                    </div>
                                    <div class="customer-review">
                                        <div class="customer-name">
                                            <h6> {{$review['name']}} </h6>
                                            <div class="reviews-group d-flex">
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star"/>
                                                </svg>
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star"/>
                                                </svg>
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star"/>
                                                </svg>
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star"/>
                                                </svg>
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @php
                                            $current_date = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$review['created_at']);
                                            $short_date = $current_date->format('Y-m-d');
                                        @endphp
                                        <div class="review-date"> @php echo $short_date;  @endphp </div>
                                        <div class="review-text">
                                            <p>  {{$review['comment']}} </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form" method="post" action="{{url('product_review')}}">
                                @csrf
                                <h5> قيم :  “{{$product['name']}}” </h5>
                                <p> لن يتم نشر عنوان بريدك الإلكتروني. الحقول المطلوبة مشار إليها * </p>
                                <div class="select-star-rating">
                                    <label> تقيمك  *</label>
                                    <span class="star-rating">
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                    </svg>
                  </span>

                                    <input type="hidden" value="{{$product['id']}}" name="product_id">
                                    <input type="hidden" id="form-input-rating" name="input_rating">
                                </div>
                                <div class="mb-4">
                                    <textarea required id="form-input-review" class="form-control form-control_gray"
                                              name="product_review"
                                              placeholder="اكتب تقيمك للمنتج " cols="30" rows="8"></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label"> الاسم  *</label>
                                    <input required type="text" id="form-input-name"
                                           class="form-control form-control-md form-control_gray" name="name">
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">البريد الالكتروني  *</label>
                                    <input id="form-input-email" class="form-control form-control-md form-control_gray"
                                           name="email" type="email">
                                </div>

                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary"> ارسال التقيم  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 dir="rtl" class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4 text-right"> ربما يعجبك أيضا </h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
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
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach($similarProducts as $product)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{url('product_details/'.$product['slug'])}}">
                                        <img loading="lazy" src="{{Storage::url($product['image'])}}" width="330"
                                             height="400"
                                             alt="Cropped Faux leather Jacket" class="pc__img">
                                        <img loading="lazy" src="{{Storage::url($product['image'])}}" width="330"
                                             height="400" alt="Cropped Faux leather Jacket"
                                             class="pc__img pc__img-second">
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
                                </div>

                                <div class="pc__info position-relative" dir="rtl">
                                    <p class="pc__category"> {{$category_data['name']}} </p>
                                    <h6  class="pc__title"><a
                                            href="{{url('product_details/'.$product['slug'])}}"> {{$product['name']}} </a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price" dir="rtl">{{$product['price']}}   ر.س  </span>
                                    </div>

{{--                                    <button--}}
{{--                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"--}}
{{--                                        title="Add To Wishlist">--}}
{{--                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"--}}
{{--                                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <use href="#icon_heart"/>--}}
{{--                                        </svg>--}}
{{--                                    </button>--}}
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

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>

    <div class="mb-5 pb-xl-5"></div>

@endsection
