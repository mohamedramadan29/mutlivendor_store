@extends('admin.layouts.master')
@section('title')
    اداره الطلبات
@endsection
@section('css')
    <link href="{{ URL::asset('assets/admin/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/admin/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/admin/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/admin/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/admin/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/  اداره الطلبات   </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- row -->
    <div class="row row-sm">

        <!-- Col -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{--                    <button data-target="#add_model"--}}
                    {{--                            data-toggle="modal" class="btn btn-primary"> أصافة قسم جديد <i--}}
                    {{--                            class="fa fa-plus"></i>--}}
                    {{--                    </button>--}}
                </div>
                <!-- Add New Section -->
                @include('admin.sections.add')
                <div class="card-body">
                    @if(Session::has('Success_message'))
                        <div
                            class="alert alert-success"> {{Session::get('Success_message')}} </div>
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example2">
                                <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0"> رقم الطلب</th>
                                    <th class="wd-15p border-bottom-0"> اسم العميل</th>
                                    <th class="wd-15p border-bottom-0"> البريد الالكتروني</th>
                                    <th class="wd-15p border-bottom-0"> رقم الهاتف</th>
                                    <th class="wd-15p border-bottom-0"> منتجات الطلب</th>
                                    <th class="wd-15p border-bottom-0"> طريقه الدفع</th>
                                    <th class="wd-15p border-bottom-0"> المجموع الكلي</th>
                                    <th class="wd-15p border-bottom-0"> حاله الطلب</th>
                                    <th class="wd-15p border-bottom-0"> تاريخ الطلب</th>
                                    <th> العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @if(count($order['order_products']) > 0)
                                        <tr>
                                            <td><a href="{{url('orders/index/'.$order['id'])}}"> {{$order['id']}} </a>
                                            </td>
                                            <td> {{$order['name']}} </td>
                                            <td> {{$order['email']}} </td>
                                            <td> {{$order['mobile']}} </td>
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
                                            <td><span class="badge badge-info"> {{$order['order_status']}} </span></td>
                                            <td> {{$order['created_at']}} </td>
                                            <td>
                                                <a href="{{url("admin/orders/order_details/".$order['id'])}}"
                                                   class="btn btn-primary btn-sm"> تفاصيل واداره الطلب </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- bd -->
                </div>

            </div>
        </div>
        <!-- /Col -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/admin/js/table-data.js') }}"></script>
    <script src="{{URL::asset('assets/admin/js/modal.js')}}"></script>
@endsection
