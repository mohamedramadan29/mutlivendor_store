@extends('new_website.layouts.master')
@section('title')
    طلباتي
@endsection
@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="my-account container" dir="rtl">
            <h2 class="page-title"> طلباتي  </h2>
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{url('user/profile')}}" class="menu-link menu-link_us-s"> الرئيسية  </a></li>
                        <li><a href="{{url('orders/index')}}"
                               class="menu-link menu-link_us-s menu-link_active"> طلباتي  </a></li>
                        <li><a href="{{url('user/edit')}}" class="menu-link menu-link_us-s"> تفاصيل الحساب  </a></li>
                        <li><a href="account_wishlist.php" class="menu-link menu-link_us-s"> المفضلة  </a></li>
                        <li><a href="{{url('user/logout')}}" class="menu-link menu-link_us-s"> تسجيل خروج  </a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__orders-list">
                        @php
                            $count_orders = \App\Models\Order::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->count();

                        @endphp
                        @if($count_orders > 0)
                            <table class="orders-table">
                                <thead>
                                <tr>
                                    <th> رقم الطلب</th>
                                    <th> منتجات الطلب</th>
                                    <th> طريقه الدفع</th>
                                    <th> المجموع الكلي</th>
                                    <th> تاريخ الطلب</th>
                                    <th> العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><a href="{{url('orders/index/'.$order['id'])}}"> {{$order['id']}} </a></td>
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
                                        <td><a class="btn btn-primary btn-sm "
                                               href="{{url('orders/index/'.$order['id'])}}">
                                                <i class="fa fa-eye"></i> تفاصيل الطلب </a></td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info"> No Orders Now</div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="mb-5 pb-xl-5"></div>

@endsection
