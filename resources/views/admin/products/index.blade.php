@extends('admin.layouts.master')
@section('title')
    المنتجات
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
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                     المنتجات</span>
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
                    <a href='{{ url('admin/product/add') }}' class="btn btn-primary"> اضافة منتج جديد <i
                            class="fa fa-plus"></i>
                    </a>
                </div>

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
                                    <th class="wd-15p border-bottom-0"> الاسم</th>
                                    <th class="wd-15p border-bottom-0"> القسم</th>
                                    <th class="wd-15p border-bottom-0"> الفئة</th>
                                    <th class="wd-15p border-bottom-0"> الكود</th>
                                    <th class="wd-15p border-bottom-0"> مالك المنتج</th>
                                    <th class="wd-15p border-bottom-0"> الصوره</th>
                                    <th class="wd-15p border-bottom-0"> الحالة</th>
                                    <th class="wd-15p border-bottom-0"> العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($allproduct as $product)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td>
                                            <a href='{{ url('admin/product/update',$product['id']) }}'>
                                                {{ $product['name'] }}
                                            </a>
                                        </td>
                                        <td> {{ $product['section']['name'] }}  </td>
                                        <td> {{ $product['category']['name'] }}  </td>
                                        <td> {{ $product['code'] }}  </td>
                                        <td>
                                            @if($product['admin_type'] == 'vendor')

                                                <a href="#">{{$product['admin_type']}}</a>
                                            @else
                                                {{  $product['admin_type']}}
                                            @endif
                                        </td>

                                        <td><img width="50px" class="img-thumbnail img-fluid"
                                                 src="{{ Storage::url($product['image']) }}">
                                        </td>
                                        <td>
                                            @if ($product['status'] == 1)
                                                <span class="badge badge-success"> نشط </span>
                                            @elseif($product['status'] == 0)
                                                <span class="badge badge-danger"> غير نشط </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href='{{ url('admin/product/update',$product['id']) }}'
                                               class="btn btn-primary btn-sm">
                                                تعديل <i class="fa fa-edit"></i></a>
                                            </a>
                                            <a href='{{ url('admin/product/add-images',$product['id']) }}'
                                               class="btn btn-warning btn-sm">
                                                معرض الصور <i class="fa fa-plus"></i></a>
                                            </a>
                                            <button data-target="#delete_model_{{ $product['id'] }}"
                                                    data-toggle="modal" class="btn btn-danger btn-sm"> حذف <i
                                                    class="fa fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    @include('admin.products.delete')
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
