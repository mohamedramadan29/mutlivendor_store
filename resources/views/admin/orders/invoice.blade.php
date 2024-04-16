@extends('admin.layouts.master')
@section('title')
    تفاصيل الطلب
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فاتورة الطلب  </span>
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
                    <img style="width: 150px;margin: auto;display: block;" src="{{asset('assets/admin/img/logo.png')}}">
                    <h4 style="font-size: 26px;font-weight: bold;color: #000;"> مرحبا {{$user['name']}} </h4>
                    <p style="color: #424040;font-size: 17px;line-height: 2;"> شكرا لطلبك، من مشتلي تم تأكيد طلبك وسوف يصلك في الوقت المحدد لإلغاء الطلب أو تعديله يرجي زيارة
                         الموقع قسم مشترياتي

                        يوجد أدناه فاتورة برقم الطلب وتفاصيله </p>
                        <table class="table table-bordered table-active">
                            <thead>
                            <tr>
                                <th> رقم الطلب: </th>
                                <th> <?php  echo DNS1D::getBarcodeHTML($order_details['id'], 'C39'); ?> </th>
                            </tr>
                            <tr>
                                <th> تاريخ الطلب: </th>
                                <th>  {{$order_details['created_at']}} </th>
                            </tr>
                            <tr>
                                <th> الاسم: </th>
                                <th>  {{$order_details['name']}} </th>
                            </tr>
                            <tr>
                                <th> البريد الألكتروني : </th>
                                <th> {{$order_details['email']}} </th>
                            </tr>
                            <tr>
                                <th>  رقم الجوال: </th>
                                <th> {{$order_details['mobile']}} </th>
                            </tr>
                            <tr>
                                <th> العنوان: </th>
                                <th> {{$order_details['address']}} </th>
                            </tr>
                            <tr>
                                <th> وسية الدفع : </th>
                                <th> {{$order_details['payment_method']}} </th>
                            </tr>
                            <tr>
                                <th> تكلفة الشحن  : </th>
                                <th> {{$order_details['shipping_price']}} </th>
                            </tr>
                            <tr>
                                <th>  السعر الكلي   : </th>
                                <th> {{$order_details['grand_total']}} ريال  </th>
                            </tr>
                            </thead>
                        </table>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-4 main-content-label"> تفاصيل الطلب  </div>
                            <table class="table table-bordered" dir="rtl">
                                <thead>
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
                                            <img class="img-fluid" width="80px" height="80px"
                                                 src="{{\Illuminate\Support\Facades\Storage::url($getproductImage)}}">
                                        </td>
                                        <td> {{$product['product_name']}} </td>
                                        <td> {{$product['product_price']}} </td>
                                        <td> {{$product['product_qty']}} </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button id="printButton" onclick="window.print(); return false;" class="btn btn-primary btn-block" style="width: 200px;margin: auto;margin-bottom: 20px;"><i
                            class="fa fa-print"></i> طباعة فاتورة
                    </button>
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
<style>
    .table thead th, .table thead td {
        color: #686868;
        font-size: 14px !important;
        padding: 10px 19px 9px !important;
    }
</style>

<style>
    @media print {

        .footer,
        .bottom_footer,
        .main_navbar,
        .instagrame_footer,
        .main-header,
        .breadcrumb-header h4,
        .breadcrumb-header span,
        .main-footer,
        #back-to-top{
            display: none !important;
        }

        #print_order {
            max-width: 100% !important;
            padding: 10px !important;
        }

        body {
            background-color: #fff;
        }

        #printButton {
            display: none !important;
        }

        .print-link {
            display: none !important;
        }

        @page {
            margin: 0;
        }

        body {
            margin: 1.6cm;
        }
    }
</style>
