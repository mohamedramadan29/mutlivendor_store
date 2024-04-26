@extends('new_website.layouts.master')
@section('title')
    تفاصيل الطلب
@endsection
@section('content')
    <div class="main-content main-content-checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-trail breadcrumbs">
                        <ul class="trail-items breadcrumb">
                            <li class="trail-item trail-begin">
                                <a href="{{url('/')}}"> الرئيسيه </a>
                            </li>
                            <li class="trail-item trail-end active">
                                تفاصيل الطلب
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3 class="custom_blog_title">
                تفاصيل الطلب -- {{$order_details['id']}}
            </h3>
            <div class="checkout-wrapp">
                <table class="table table-bordered" dir="rtl">
                    <tr>
                        <th> رقم الطلب</th>
                        <td>  {{$order_details['id']}} </td>
                    </tr>
                    <tr>
                        <th> طريقه الدفع</th>
                        <td>  {{$order_details['payment_method']}} </td>
                    </tr>
                    <tr>
                        <th> المجموع الكلي</th>
                        <td>  {{$order_details['grand_total']}} <span> ر.س </span></td>
                    </tr>
                    <tr>
                        <th> تاريخ الطلب</th>
                        <td>  {{$order_details['created_at']}} </td>
                    </tr>
                </table>
                <!-------- منتجات الطلب  ------>
                <table class="table table-bordered" dir="rtl">
                    <thead>
                    <tr>
                        <th colspan="4"> منتجات الطلب</th>
                    </tr>
                    <tr>
                        <th> صوره المنتج</th>
                        <th> اسم المنتج</th>
                        <th> سعر المنتج</th>
                        <th> الكميه</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order_details['order_products'] as $product)
                        <tr>
                            <td>
                                @php
                                    $getproductImage = \App\Models\admin\Product::getproductImage($product['product_id']);
                                @endphp
                                <img class="img-fluid" width="80px" height="80px" src="{{\Illuminate\Support\Facades\Storage::url($getproductImage)}}">
                            </td>
                            <td> {{$product['product_name']}} </td>
                            <td> {{$product['product_price']}} </td>
                            <td> {{$product['product_qty']}} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!--------  معلومات الشحن   ------>
                <table class="table table-bordered" dir="rtl">
                    <thead>
                    <tr>
                        <th colspan="4"> معلومات شحن الطلب</th>
                    </tr>
                    <tr>
                        <th> الاسم</th>
                        <td> {{$order_details['name']}} </td>
                    </tr>
                    <tr>
                        <th> العنوان</th>
                        <td> {{$order_details['address']}} </td>
                    </tr>
                    <tr>
                        <th> المدينه</th>
                        <td> {{$order_details['city']}} </td>
                    </tr>
                    <tr>
                        <th> الولايه</th>
                        <td> {{$order_details['state']}} </td>
                    </tr>
                    <tr>
                        <th> الدوله</th>
                        <td> {{$order_details['country']}} </td>
                    </tr>
                    <tr>
                        <th> الرمز البريدي</th>
                        <td> {{$order_details['pincode']}} </td>
                    </tr>

                    </thead>
                </table>

            </div>
        </div>
    </div>

@endsection
