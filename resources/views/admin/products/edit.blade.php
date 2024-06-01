@extends('admin.layouts.master')
@section('title')
    تعديل المنتج
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                     تعديل المنتج  </span>
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
                          action="{{ url('admin/product/update',$product['id']) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> حدد القسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='category_id'>
                                                <option> -- حدد نوع القسم --</option>
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{$section['name']}}"></optgroup>
                                                    @foreach($section['categories'] as $categoryy)
                                                        <option
                                                            @if($categoryy['id'] == $product['category_id']) selected
                                                            @endif value="{{$categoryy['id']}}">  {{$categoryy['name']}}
                                                            &nbsp;&nbsp; <<
                                                        </option>
                                                        @foreach($categoryy['subcategory'] as $subcategory)
                                                            <option
                                                                @if($subcategory['id'] == $product['category_id']) selected
                                                                @endif value="{{$subcategory['id']}}">  {{$subcategory['name']}}
                                                                &nbsp;&nbsp; <<<
                                                            </option>
                                                        @endforeach

                                                    @endforeach

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> العلامه التجارية </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='brand_id'>
                                                <option> -- حدد نوع العلامة التجارية --</option>
                                                <option @if($product['brand_id'] == 0) selected @endif value="0"> لا
                                                    يوجد
                                                </option>
                                                @foreach ($allbrands as $brand)
                                                    <option @if($brand['id'] == $product['brand_id']) selected
                                                            @endif value='{{ $brand['id'] }}'> {{ $brand['name'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الأسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="text" class="form-control" name="name"
                                                   value="{{$product['name']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الأسم [en]</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="text" class="form-control" name="name_en"
                                                   value="{{$product['name_en']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> كود المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="code"
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
                                            <input required type="text" class="form-control" name="price"
                                                   value="{{$product['price']}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الصورة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="image"
                                                   accept="image/*">
                                            <img width="50px" class="img-thumbnail img-fluid" src="{{asset('assets/images/product_images/'.$product['image'])}}">

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


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> قيمه الخصم [ريال] </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="discount"
                                                   value="{{$product['discount']}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> وزن المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="weight"
                                                   value="{{$product['weight']}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> وصف المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea required class='form-control'
                                                      name='description'>{{$product['description']}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> [en] وصف المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea required class='form-control'
                                                      name='description_en'>{{$product['description_en']}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> حالة المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='status'>
                                                <option> -- حدد حالة المنتج --</option>
                                                <option @if($product['status'] == 1) selected @endif value='1'> فعال
                                                </option>
                                                <option @if($product['status'] == 0) selected @endif value='0'> غير
                                                    فعال
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> منتج مميز </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='is_feature'>
                                                <option> -- منتج مميز --</option>
                                                <option @if($product['is_feature'] == 1) selected @endif value='1'>
                                                    مميز
                                                </option>
                                                <option @if($product['is_feature'] == 0) selected @endif value='0'>
                                                    عادي
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @if($user_type == 'Super Admin')
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label"> افضل المبيعات </label>
                                            </div>
                                            <div class="col-md-9">
                                                <select required class='form-control select2' name='best_seller'>
                                                    <option> -- افضل المبيعات --</option>
                                                    <option @if($product['best_seller'] == 1) selected
                                                            @endif  value='1'> نعم
                                                    </option>
                                                    <option @if($product['best_seller'] == 0) selected @endif value='0'>
                                                        لا
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="best_seller" value="0">
                                @endif


                                <h4 class='badge badge-info'> معلومات السيو </h4>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> العنوان </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_title"
                                                   value="{{$product['meta_title']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الوصف </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class='form-control'
                                                      name='meta_description'>{{$product['meta_description']}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الكلمات المفتاحية <span
                                                    class='badge badge-danger'>
                                                    افصل بين كل كلمة والاخري ب [ , ] </span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_keywords"
                                                   value="{{$product['meta_keywords']}}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class='btn btn-primary' type='submit'> تعديل المنتج </button>
                        </div>
                    </form>
                        <br>
                    <h6> معرض الصور </h6>
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
                                    <td>
                                        <img width="50px" class="img-thumbnail img-fluid" src="{{asset('assets/images/gallary_product_images/'.$image_data['image'])}}">
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
        <!-- /Col -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
