@extends('website.layouts.master')
@section('content')
    <div>
        <div class="main-content main-content-details single left-sidebar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-trail breadcrumbs">
                            <ul class="trail-items breadcrumb">
                                <li class="trail-item trail-begin">
                                    <a href="{{url('/')}}"> الرئيسيه </a>
                                </li>
                                <li class="trail-item">
                                    <a href="{{url('category/'.$category_data['slug'])}}">  {{$category_data['name']}} </a>
                                </li>
                                <li class="trail-item trail-end active">
                                    {{$product['name']}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="content-area content-details col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="site-main">
                            <div class="details-product">
                                <div class="details-thumd">
                                    <div class="image-preview-container image-thick-box image_preview_container">
                                        <img id="img_zoom" data-zoom-image="{{Storage::url($product->image)}}"
                                             src="{{Storage::url($product->image)}}" alt="img">
                                        <a href="#" class="btn-zoom open_qv"><i class="fa fa-search"
                                                                                aria-hidden="true"></i></a>
                                    </div>
                                    <div class="product-preview image-small product_preview">
                                        <div id="thumbnails" class="thumbnails_carousel owl-carousel" data-nav="true"
                                             data-autoplay="false" data-dots="false" data-loop="false" data-margin="10"
                                             data-responsive='{"0":{"items":3},"480":{"items":3},"600":{"items":3},"1000":{"items":3}}'>
                                            @if($product['productImages'] !=null)
                                                @foreach($product['productImages'] as $sub_image)
                                                    <a href="#"
                                                       data-image="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                       data-zoom-image="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                       class="active">
                                                        <img
                                                            src="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                            data-large-image="{{\Illuminate\Support\Facades\Storage::url($sub_image->image)}}"
                                                            alt="img">
                                                    </a>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="details-infor">
                                    @if(Session::has('Success_message'))
                                        <div
                                            class="alert alert-success"> {{Session::get('Success_message')}} <a href="{{url('cart/show')}}" style="color: red"> مشاهده السله  </a> </div>
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
                                    <h1 class="product-title">
                                        {{$product['name']}}
                                        <hr>
                                        {{$product['code']}}
                                    </h1>
                                    <div class="stars-rating">
                                        <div class="star-rating">
                                            <span class="star-5"></span>
                                        </div>
                                        <div class="count-star">
                                            (7)
                                        </div>
                                    </div>
                                    <div class="availability">
                                        حاله المنتج :
                                        <a href="#"> متوفر </a>
                                    </div>
                                    @if(isset($product['vendor']) && $product['vendor'] !=null)
                                        <div class="availability">
                                            اسم التاجر :
                                            <a href="{{url('products/'.$product['vendor']['vendorbuisnessdetails']['store_website'])}}">  {{$product['vendor']['vendorbuisnessdetails']['store_name']}} </a>
                                        </div>
                                    @endif
                                    <div class="price">
                                        <span> {{$product['price']}} ر.س </span>
                                    </div>
                                    <div class="product-details-description">
                                        {{$product['short_description']}}

                                    </div>

                                    <div class="group-button">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <div class="yith-wcwl-add-button">
                                                <a href="#"> الاضافه الي المفضله </a>
                                            </div>
                                        </div>
                                        <form action="{{url('cart/add')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product['id']}}">
                                            <div class="quantity-add-to-cart">
                                                <div class="quantity">
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                        <input type="text" name="qty" data-step="1" data-min="0"
                                                               value="1"
                                                               title="Qty"
                                                               class="input-qty qty" size="4">
                                                        <a href="#" class="btn-number qtyplus quantity-plus">+</a>
                                                    </div>
                                                </div>
                                                <button type="submit" class="single_add_to_cart_button button"> اضافه
                                                    الي السله
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-details-product">
                                <ul class="tab-link">
                                    <li class="active">
                                        <a data-toggle="tab" aria-expanded="true" href="#product-descriptions">
                                            الوصف </a>
                                    </li>
                                    {{--                                    <li class="">--}}
                                    {{--                                        <a data-toggle="tab" aria-expanded="true" href="#information"> معلومات--}}
                                    {{--                                            اضافيه </a>--}}
                                    {{--                                    </li>--}}
                                    <li class="">
                                        <a data-toggle="tab" aria-expanded="true" href="#reviews"> التقيمات </a>
                                    </li>
                                </ul>
                                <div class="tab-container">
                                    <div id="product-descriptions" class="tab-panel active">
                                        <p>
                                            {{$product['description']}}
                                        </p>

                                    </div>
                                    {{--                                    <div id="information" class="tab-panel">--}}
                                    {{--                                        <table class="table table-bordered">--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>Size</td>--}}
                                    {{--                                                <td> XS / S / M / L</td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>Color</td>--}}
                                    {{--                                                <td>White/ Black/ Teal/ Brown</td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>Properties</td>--}}
                                    {{--                                                <td>Colorful Dress</td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                        </table>--}}
                                    {{--                                    </div>--}}
                                    <div id="reviews" class="tab-panel">
                                        <div class="reviews-tab">
                                            <div class="comments">
                                                <h2 class="reviews-title">
                                                    1 مراجعه ل
                                                    <span> المنتج الاول </span>
                                                </h2>
                                                <ol class="commentlist">
                                                    <li class="conment">
                                                        <div class="conment-container">
                                                            <a href="#" class="avatar">
                                                                <img src="assets/images/avartar.png" alt="img">
                                                            </a>
                                                            <div class="comment-text">
                                                                <div class="stars-rating">
                                                                    <div class="star-rating">
                                                                        <span class="star-5"></span>
                                                                    </div>
                                                                    <div class="count-star">
                                                                        (1)
                                                                    </div>
                                                                </div>
                                                                <p class="meta">
                                                                    <strong class="author"> محمد احمد </strong>
                                                                    <span>-</span>
                                                                    <span class="time">June 7, 2013</span>
                                                                </p>
                                                                <div class="description">
                                                                    <p> تصميم بسيط وفعال. واحد من المفضلين لدي. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div>
                                            <div class="review_form_wrapper">
                                                <div class="review_form">
                                                    <div class="comment-respond">
                                                        <span class="comment-reply-title"> اضافه تقيم </span>
                                                        <form class="comment-form-review">
                                                            <p class="comment-notes">
                                                                <span class="email-notes"> لن يتم نشر عنوان بريدك الإلكتروني. </span>
                                                                تم وضع علامة على الحقول المطلوبة
                                                                <span class="required">*</span>
                                                            </p>
                                                            <div class="comment-form-rating">
                                                                <label> تقيمك </label>
                                                                <p class="stars">
															<span>
																<a class="star-1" href="#"></a>
																<a class="star-2" href="#"></a>
																<a class="star-3" href="#"></a>
																<a class="star-4" href="#"></a>
																<a class="star-5" href="#"></a>
															</span>
                                                                </p>
                                                            </div>
                                                            <p class="comment-form-comment">
                                                                <label>
                                                                    اكتب تقيمك
                                                                    <span class="required">*</span>
                                                                </label>
                                                                <textarea title="review" id="comment" name="comment"
                                                                          cols="45" rows="8"></textarea>
                                                            </p>
                                                            <p class="comment-form-author">
                                                                <label>
                                                                    الاسم
                                                                    <span class="">*</span>
                                                                </label>
                                                                <input title="author" id="author" name="author"
                                                                       type="text" value="">
                                                            </p>
                                                            <p class="comment-form-email">
                                                                <label>
                                                                    البريد الالكتروني
                                                                    <span class="">*</span>
                                                                </label>
                                                                <input title="email" id="email" name="email"
                                                                       type="email" value="">
                                                            </p>
                                                            <p class="form-submit">
                                                                <input name="submit" type="submit" id="submit"
                                                                       class="submit" value=" ارسال التقيم  ">
                                                            </p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: left;"></div>
                            <div class="related products product-grid">
                                <h2 class="product-grid-title">ربما يعجبك أيضا</h2>
                                <div class="owl-products owl-slick equal-container nav-center"
                                     data-slick='{"autoplay":false, "autoplaySpeed":1000, "arrows":true, "dots":false, "infinite":true, "speed":800, "rows":1}'
                                     data-responsive='[{"breakpoint":"2000","settings":{"slidesToShow":4}},{"breakpoint":"1200","settings":{"slidesToShow":2}},{"breakpoint":"992","settings":{"slidesToShow":2}},{"breakpoint":"480","settings":{"slidesToShow":1}}]'>
                                    @foreach($similarProducts as $product)
                                        <div class="product-item style-1">
                                            <div class="product-inner equal-element">
                                                <div class="product-top">

                                                </div>
                                                <div class="product-thumb">
                                                    <div class="thumb-inner">
                                                        <a href="{{url('product_details/'.$product['slug'])}}">
                                                            <img src="{{Storage::url($product['image'])}}" alt="img">
                                                        </a>
                                                        <div class="thumb-group">
                                                            <div class="yith-wcwl-add-to-wishlist">
                                                                <div class="yith-wcwl-add-button">
                                                                    <a href="#">Add to Wishlist</a>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="button quick-wiew-button">Quick View</a>
                                                            <div class="loop-form-add-to-cart">
                                                                <button class="single_add_to_cart_button button">Add to
                                                                    cart
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name product_title">
                                                        <a href="{{url('product_details/'.$product['slug'])}}">{{$product['name']}}</a>
                                                    </h5>
                                                    <div class="group-info">
                                                        <div class="stars-rating">
                                                            <div class="star-rating">
                                                                <span class="star-3"></span>
                                                            </div>
                                                            <div class="count-star">
                                                                (3)
                                                            </div>
                                                        </div>
                                                        <div class="price">
                                                            <del>
                                                                $65
                                                            </del>
                                                            <ins>
                                                                $45
                                                            </ins>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
