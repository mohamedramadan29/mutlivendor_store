@extends('admin.layouts.master')
@section('title')
    كوبونات الخصم
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
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كوبونات الخصم
                      كوبونات الخصم  </span>
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
                    <a href='{{ url('admin/add_coupon') }}' class="btn btn-primary">  اضافه كوبون جديد  <i
                            class="fa fa-plus"></i>
                    </a>
                </div>
                <!-- Add New Section -->
                @include('admin.sections.add')
                <div class="card-body">
                    @if (Session::has('Success_message'))
                        <div class="alert alert-success"> {{ Session::get('Success_message') }} </div>
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
                                    <th class="wd-15p border-bottom-0"> #</th>
                                    <th class="wd-15p border-bottom-0"> كود الخصم</th>
                                    <th class="wd-15p border-bottom-0"> نوع الكود</th>
                                    <th class="wd-15p border-bottom-0"> نوع الخصم</th>
                                    <th class="wd-15p border-bottom-0"> قيمه الخصم</th>
                                    <th class="wd-15p border-bottom-0"> تاريخ الانتهاء</th>
                                    <th class="wd-15p border-bottom-0"> حاله الكود</th>
                                    <th class="wd-15p border-bottom-0"> العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($allcoupons as $coupon)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td>
                                            <a href='{{ url('admin/update_coupon',$coupon['id']) }}'>
                                                {{ $coupon['coupon_code'] }}
                                            </a>
                                        </td>
                                        <td> {{ $coupon['coupon_type'] }}  </td>
                                        <td> {{ $coupon['amount_type'] }}  </td>
                                        <td> {{ $coupon['amount'] }}  </td>
                                        <td> {{ $coupon['expire_date'] }}  </td>
                                        <td>
                                            @if($coupon['status'] == 0) <span
                                                class="badge badge-danger"> غير فعال </span>
                                            @else
                                                <span class="badge badge-danger">  فعال </span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href='{{ url('admin/update_coupon',$coupon['id']) }}'
                                               class="btn btn-primary btn-sm">
                                                تعديل <i class="fa fa-edit"></i></a>
                                            </a>
                                            <button data-target="#delete_model_{{ $coupon['id'] }}"
                                                    data-toggle="modal" class="btn btn-danger btn-sm"> حذف <i
                                                    class="fa fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    @include('admin.Coupons.delete')
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
    <script src="{{ URL::asset('assets/admin/js/modal.js') }}"></script>
@endsection
