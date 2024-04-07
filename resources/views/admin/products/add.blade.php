@extends('admin.layouts.master')
@section('title')
    اضافة منتج جديد
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة منتج جديد</span>
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


                    <form class="form-horizontal" method="post" action="{{ url('admin/product/add') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">  حدد القسم  </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='category_id'>
                                                <option> -- حدد نوع القسم --</option>
                                                @foreach ($categories as $section)
                                                    <optgroup label="{{$section['name']}}"></optgroup>
                                                @foreach($section['categories'] as $categoryy)
                                                    <option value="{{$categoryy['id']}}">  {{$categoryy['name']}} &nbsp;&nbsp; << </option>
                                                        @foreach($categoryy['subcategory'] as $subcategory)
                                                            <option value="{{$subcategory['id']}}">  {{$subcategory['name']}} &nbsp;&nbsp; <<< </option>
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
                                                <option value="0"> لا يوجد</option>
                                                @foreach ($allbrands as $brand)
                                                    <option value='{{ $brand['id'] }}'> {{ $brand['name'] }} </option>
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
                                            <input required type="text" class="form-control" name="name" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> كود المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="code" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> السعر </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="text" class="form-control" name="price" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> قيمه الخصم [ريال] </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="discount" value="">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الصورة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="file" class="form-control" name="image"
                                                   accept="image/*">
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
                                            <input type="text" class="form-control" name="weight" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> وصف المنتج </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea required class='form-control' name='description'></textarea>
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
                                                <option value='1'> فعال</option>
                                                <option value='0'> غير فعال</option>
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
                                                <option value='1'> مميز</option>
                                                <option value='0'> عادي</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 @if($user_type == 'Super Admin')
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">  افضل المبيعات  </label>
                                            </div>
                                            <div class="col-md-9">
                                                <select required class='form-control select2' name='best_seller'>
                                                    <option> --  افضل المبيعات  --</option>
                                                    <option value='1'> نعم </option>
                                                    <option value='0'>  لا </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                     <input type="hidden" name="best_seller" value="0" >
                                 @endif


                                <h4 class='badge badge-info'> معلومات السيو </h4>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> العنوان </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_title" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الوصف </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class='form-control' name='meta_description'></textarea>
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
                                                   value="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class='btn btn-primary' type='submit'>  اضافه منتج   </button>
                        </div>
                    </form>

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
