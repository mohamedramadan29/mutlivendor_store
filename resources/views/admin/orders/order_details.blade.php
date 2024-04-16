@extends('admin.layouts.master')
@section('title')
    تفاصيل الطلب
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الطلب  </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- row -->
    <div class="row row-sm">
        <!-- Col -->
        <div class="col-lg-12">
            <div class="card">
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
                    <div class="mb-4 main-content-label"> معلومات الطلب</div>


                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> رقم الطلب </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="name"
                                               value="{{$order_details['id']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">طريقه الدفع</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="email" class="form-control" name="email"
                                               value=" {{$order_details['payment_method']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> قيمه الشحن </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" name="mobile" class="form-control"
                                               value=" {{$order_details['shipping_price']}} ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> كوبون الخصم </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" name="mobile" class="form-control"
                                               value=" {{$order_details['coupon_code']}} ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> قيمه الخصم </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" name="mobile" class="form-control"
                                               value=" {{$order_details['coupon_amount']}} ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> المجموع الكلي</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" name="mobile" class="form-control"
                                               value=" {{$order_details['grand_total']}} ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> تاريخ الطلب </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" name="mobile" class="form-control"
                                               value=" {{$order_details['created_at']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 main-content-label"> تعديل حاله الطلب</div>
                            <form method="post" action="{{url('admin/update_order_status')}}">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$order_details['id']}}">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> تعديل حاله الطلب </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control select2" name="order_status">
                                                <option> حدد حاله الطلب</option>
                                                @foreach($order_statuss as $status)
                                                    <option
                                                        @if($order_details['order_status'] == $status['name']) selected
                                                        @endif value="{{$status['name']}}"> {{$status['name']}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm"> تعديل الحاله</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-lg-6 col-12">

                            <div class="mb-4 main-content-label"> معلومات شحن الطلب</div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> الاسم </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="address"
                                               value="{{$order_details['name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> البريد الالكتروني </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="address"
                                               value="{{$order_details['email']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> رقم الهاتف </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="address"
                                               value="{{$order_details['mobile']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> العنوان </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="city"
                                               value="{{$order_details['address']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> المدينه </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="state"
                                               value="{{$order_details['city']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> الولايه </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="state"
                                               value="{{$order_details['state']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> الدولة </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="country"
                                               value="{{$order_details['country']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label"> الرمز البريدي </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input readonly type="text" class="form-control" name="pincode"
                                               value="{{$order_details['pincode']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-4 main-content-label"> منتجات الطلب</div>

                            <table class="table table-bordered" dir="rtl">
                                <thead>
                                <tr>
                                    <th> صوره المنتج</th>
                                    <th> اسم المنتج</th>
                                    <th> سعر المنتج</th>
                                    <th> الكميه</th>
                                    <th> تعديل حالة المنتج  </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_details['order_products'] as $product)
                                    <tr>
                                        <td>
                                            @php
                                                $getproductImage = \App\Models\admin\Product::getproductImage($product['product_id']);
                                            @endphp
                                            <img class="img-fluid" width="80px" height="80px"
                                                 src="{{\Illuminate\Support\Facades\Storage::url($getproductImage)}}">
                                        </td>
                                        <td> {{$product['product_name']}} </td>
                                        <td> {{$product['product_price']}} </td>
                                        <td> {{$product['product_qty']}} </td>
                                        <td>
                                            <form method="post" action="{{url('admin/update_item_status')}}">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{$product['id']}}">
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <select class="form-control select2" name="order_item_status">
                                                                <option> حدد حالة المنتج </option>
                                                                @foreach($order_statuss as $status)
                                                                    <option
                                                                        @if($product['item_status'] == $status['name']) selected
                                                                        @endif value="{{$status['name']}}"> {{$status['name']}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="form-label"> </label>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-sm"> تعديل
                                                            الحاله
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <div class="mb-4 main-content-label"> سلسلة حالات الطلب   </div>
                        <div class="row">
                            <table class="table-bordered table">
                                <thead>
                                <tr>
                                    <th> حالة الطلب  </th>
                                    <th> تاريخ تغير الحالة  </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($order_logs as $log)
                                    <tr>
                                        <td> {{$log['order_status']}} </td>
                                        <td>  {{$log['created_at']}} </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    {{--                    <form class="form-horizontal" method="post" action="{{url('admin/admin/view_vendor_details/'.$vendor_data_in_admin['vendor_id'])}}" enctype="multipart/form-data">--}}
                    {{--                        @csrf--}}
                    {{--                        <div class="form-group ">--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col-md-3">--}}
                    {{--                                    <label class="form-label">  تعديل حالة التاجر </label>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-md-9">--}}
                    {{--                                    <select class="form-control select2" name="person_status">--}}
                    {{--                                        <option> -- حدد حالة التاجر  -- </option>--}}
                    {{--                                        <option @if($vendor_data_in_admin['status'] ==1) selected @endif value="1"> فعال </option>--}}
                    {{--                                        <option @if($vendor_data_in_admin['status'] ==0) selected @endif value="0">غير  فعال </option>--}}
                    {{--                                    </select>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-footer text-left">--}}
                    {{--                            <button type="submit" class="btn btn-primary waves-effect waves-light">تعديل البيانات--}}
                    {{--                            </button>--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}
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
