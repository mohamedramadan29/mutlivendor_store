@extends('new_website.layouts.master')
@section('title')  {{$category_data['name']}}  @endsection
@section('content')
    <main>
        <section class="full-width_padding shop_page_header">
            <div class="full-width_border border-2" style="border-color: #eeeeee;">
                <div class="shop-banner position-relative ">
                    <div class="background-img">
                        <img loading="lazy" src="{{asset('assets/new_website/images/logo.png')}}"
                             width="420" height="420"
                             alt="Pattern" class="object-fit-cover">
                    </div>

                    <div class="shop-banner__content container position-absolute start-50 top-50">
                        <h2 class="stroke-text h1 smooth-16 text-uppercase fw-bold mb-3 mb-xl-4 mb-xl-5 text-center"> {{$category_data['name']}} </h2>

                    </div><!-- /.shop-banner__content -->
                </div><!-- /.shop-banner position-relative -->
            </div><!-- /.full-width_border -->
        </section><!-- /.full-width_padding-->

        <div class="mb-4 pb-lg-3"></div>

        <section class="shop-main"  dir="rtl">
            <div class="container">
                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="{{url('/')}}" class="menu-link menu-link_us-s text-uppercase fw-medium"> الرئيسية  </a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="{{url('shop')}}" class="menu-link menu-link_us-s text-uppercase fw-medium"> المتجر   </a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium"> {{$category_data['name']}} </a>
                    </div><!-- /.breadcrumb -->

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">

                        <form class="filter-choice select-form" name="sortProducts" id="sortProducts">
                            {{--                                <span class="title"> ترتيب حسب </span>--}}
                            <select aria-label="Sort Items" name="sort" title="sort-by" data-placeholder="Price: Low to High" id="sort" class="chosen-select shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0">
                                <option value="" selected> رتب حسب  </option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == 'price_from_low_heigh') selected @endif value="price_from_low_heigh"> السعر : من الاقل الي الاعلي </option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == 'price_from_hieght_low') selected @endif value="price_from_hieght_low"> السعر : من الاعلي الي الاقل </option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == 'oldest') selected @endif value="oldest"> رتب حسب  الاقدم  </option>
                                <option @if(isset($_GET['sort']) && $_GET['sort'] == 'latest') selected @endif value="latest">رتب حسب الاحدث </option>
                            </select>
                        </form>
                    </div><!-- /.shop-acs -->
                </div><!-- /.d-flex justify-content-between -->
                <div>
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
                <div class="products-grid row row-cols-2 row-cols-md-3 row-cols-lg-4" id="products-grid">
                    @foreach($products as $product)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                         data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a href="{{url('product_details/'.$product['slug'])}}"><img
                                                        loading="lazy"
                                                        src="{{Storage::url($product['image'])}}"
                                                        width="330" height="400"
                                                        alt="Cropped Faux leather Jacket"
                                                        class="pc__img"></a>
                                            </div><!-- /.pc__img-wrapper -->
                                            @foreach($product['productImages'] as $sub_image)
                                                <div class="swiper-slide">
                                                    <a href="{{url('product_details/'.$product['slug'])}}"><img
                                                            loading="lazy"
                                                            src="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                            width="330" height="400"
                                                            alt="Cropped Faux leather Jacket"
                                                            class="pc__img"></a>
                                                </div><!-- /.pc__img-wrapper -->
                                            @endforeach
                                        </div>
                                        <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                                        xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_prev_sm"/>
                  </svg></span>
                                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                                        xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_next_sm"/>
                  </svg></span>
                                    </div>

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

                                <div class="pc__info position-relative">

                                    <h6 class="pc__title"><a href="{{url('product_details/'.$product['slug'])}}"> {{$product['name']}}  </a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price" dir="rtl">{{$product['price']}}   ر.س  </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- /.products-grid row -->

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item @if ($products->onFirstPage()) disabled @endif">
                            <a class="page-link" href="{{ $products->previousPageUrl() . (request()->has('sort') ? '&sort=' . request()->sort : '') }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only"> السابق  </span>
                            </a>
                        </li>

                        @php
                            $maxPagesToShow = 3; // عدد الصفحات التي تريد عرضها
                            $currentPage = $products->currentPage();
                            $lastPage = $products->lastPage();
                            $start = max($currentPage - floor($maxPagesToShow / 2), 1);
                            $end = min($start + $maxPagesToShow - 1, $lastPage);
                        @endphp

                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item @if ($i === $currentPage) active @endif">
                                <a class="page-link" href="{{ $products->url($i) . (request()->has('sort') ? '&sort=' . request()->sort : '') }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item @if (!$products->hasMorePages()) disabled @endif">
                            <a class="page-link" href="{{ $products->nextPageUrl() . (request()->has('sort') ? '&sort=' . request()->sort : '') }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only"> التالي  </span>
                            </a>
                        </li>
                    </ul>
                </nav>


            </div>
        </section><!-- /.shop-main container -->
    </main>
    <div class="mb-5 pb-xl-5"></div>
@endsection

