@extends('website.layouts.master')
@section('title')
    الطلبات
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
                                الطلبات
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h3 class="custom_blog_title">
                الطلبات
            </h3>
            <div class="checkout-wrapp">
                <table class="table" dir="rtl">
                    <tr>
                        <th> رقم الطلب</th>
                        <th> منتجات الطلب</th>
                        <th> طريقه الدفع</th>
                        <th> المجموع الكلي</th>
                        <th> تاريخ الطلب</th>
                    </tr>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td> <a href="{{url('orders/index/'.$order['id'])}}"> {{$order['id']}} </a>   </td>
                            <td>
                            @foreach($order['order_products'] as $product)
                                {{$product['product_name']}} <br>
                            @endforeach
                            </td>
                            <td> @if($order['payment_method'] == 'cod')
                                    <span> الدفع عند الاستلام  </span>
                                @else
                                    <span> الدفع اون لاين  </span>
                                @endif   </td>
                            <td> {{ $order['grand_total']  }} <span> ر.س </span></td>
                            <td> {{$order['created_at']}} </td>
                            <td> <a class="btn btn-primary btn-sm " href="{{url('orders/index/'.$order['id'])}}"> <i class="fa fa-eye"></i> تفاصيل الطلب  </a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
