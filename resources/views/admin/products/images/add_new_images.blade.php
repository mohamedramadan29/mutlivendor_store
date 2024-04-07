@extends('admin.layouts.master')
@section('title')
    اضافه صور اضافيه للمنتج
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                      اضافه صور اضافيه للمنتج    </span>
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

                    <form class="form-horizontal" method="post"
                          action="{{ url('admin/product/add-images',$product['id']) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الأسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input disabled type="text" class="form-control" name="name"
                                                   value="{{$product['name']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> كود المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input disabled type="text" class="form-control" name="code"
                                                   value="{{$product['code']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> السعر </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input disabled required type="text" class="form-control" name="price"
                                                   value="{{$product['price']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> صوره المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <img class="img-product" width="80px" height="70px"
                                                 src="{{\Illuminate\Support\Facades\Storage::url($product['image'])}}">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> اضافه صور المعرض </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" multiple class="form-control" name="images[]">
                                        </div>
                                    </div>
                                </div>
                                <button class='btn btn-primary' type='submit'> اضافه صور اضافيه</button>
                            </div>
                        </div>
                    </form>
                        <br>
                    <div class="col-lg-6 col-12">
                        <table class="table table-bordered">
                            <thead>
                            <th> الصوره</th>
                            <th> العمليات</th>
                            </thead>
                            <tbody>
                            @foreach($product['productImages'] as $image_data)
                                <tr>
                                    <td><img width="100px"
                                             src="{{\Illuminate\Support\Facades\Storage::url($image_data->image)}}">
                                    </td>
                                    <td>
                                        <button data-target="#delete_model_{{ $image_data['id'] }}"
                                                data-toggle="modal" class="btn btn-danger btn-sm"> حذف <i
                                                class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('admin.products.images.delete')
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>


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
