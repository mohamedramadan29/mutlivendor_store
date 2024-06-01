@extends('admin.layouts.master')
@section('title')
    الرئيسية
@endsection

@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/admin/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet"/>
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا ,  {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}} </h2>
                <p class="mg-b-0"> لوحة التحكم الخاصة بك </p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">

        <!--======================================================== Admin Dashboard ==================================================-->
        @if(\Illuminate\Support\Facades\Auth::guard('admin')->user()->type == 'Super Admin')
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> جميع المنتجات  </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white"> @php echo count(\App\Models\Admin\Product::all()) @endphp  </h4>
                                    <a href="{{url('admin/products')}}" class="mb-0 tx-12 text-white op-7"> مشاهدة التفاصيل  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> فئات الاقسام الرئيسية للمتجر   </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white"> @php echo count(\App\Models\admin\Category::all()) @endphp </h4>
                                    <a href="{{url('admin/categories')}}" class="mb-0 tx-12 text-white op-7"> مشاهدة التفاصيل  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> العلامات التجارية  </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white"> @php echo count(\App\Models\Admin\Brand::all()) @endphp </h4>
                                    <a href="{{url('admin/brands')}}" class="mb-0 tx-12 text-white op-7"> مشاهدة التفاصيل  </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="card overflow-hidden sales-card bg-info-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white"> المستخدمين  </h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white"> @php echo count(\App\Models\User::all()) @endphp </h4>
                                    <a href="{{url('admin/users')}}" class="mb-0 tx-12 text-white op-7"> مشاهدة التفاصيل  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">  اخر الطلبات </h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                    <div class="table-responsive country-table">
                        <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                            <thead>
                            <tr>

                                <th class="wd-15p border-bottom-0"> رقم الطلب</th>
                                <th class="wd-15p border-bottom-0"> اسم العميل</th>
                                <th class="wd-15p border-bottom-0"> البريد الالكتروني</th>
                                <th class="wd-15p border-bottom-0"> رقم الهاتف</th>
                                <th class="wd-15p border-bottom-0"> طريقه الدفع</th>
                                <th class="wd-15p border-bottom-0"> المجموع الكلي</th>
                                <th class="wd-15p border-bottom-0"> حاله الطلب</th>
                                <th class="wd-15p border-bottom-0"> تاريخ الطلب</th>
                                <th> العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($last_orders as $order)
                                <tr>
                                    <td><a href="{{url('orders/index/'.$order['id'])}}"> {{$order['id']}} </a>
                                    </td>
                                    <td> {{$order['name']}} </td>
                                    <td> {{$order['email']}} </td>
                                    <td> {{$order['mobile']}} </td>
                                    <td> @if($order['payment_method'] == 'cod')
                                            <span> الدفع عند الاستلام  </span>
                                        @else
                                            <span> الدفع اون لاين  </span>
                                        @endif   </td>
                                    <td> {{ $order['grand_total']  }} <span> ر.س </span></td>
                                    <td><span class="badge badge-info"> {{$order['order_status']}} </span></td>
                                    <td> {{$order['created_at']}} </td>
                                    <td>
                                        <a href="{{url("admin/orders/order_details/".$order['id'])}}"
                                           class="btn btn-primary btn-sm"> تفاصيل الطلب  </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/admin/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/admin/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/admin/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/admin/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/jquery.vmap.sampledata.js') }}"></script>
@endsection

