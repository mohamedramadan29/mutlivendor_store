@extends('admin.layouts.master')
@section('title')
    اضافة فئة قسم جديد
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فئة قسم جديد</span>
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


                    <form class="form-horizontal" method="post" action="{{ url('admin/add_category') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label"> نوع الفئة [ فرعي / رئيسي ] </label>
                                        </div>
                                        <div class="col-md-8">
                                            <select required class='form-control select2' name='parent_id'>
                                                <option> -- حدد نوع الفئة -- </option>
                                                <option value='0'> رئيسي </option>
                                                @foreach ($allcats as $cat)
                                                    <option value='{{ $cat['id'] }}'> {{ $cat['name'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> حدد القسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='section_id'>
                                                <option> -- حدد نوع القسم -- </option>

                                                @foreach ($allsections as $section)
                                                    <option value='{{ $section['id'] }}'> {{ $section['name'] }} </option>
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
                                            <label class="form-label"> وصف القسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea  class='form-control' name='description'></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> حالة القسم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='status'>
                                                <option> -- حدد حالة القسم -- </option>
                                                <option value='1'> فعال </option>
                                                <option value='0'> غير فعال </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> قيمة الخصم [ % ] </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="discount" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">الصورة </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                        @if (!empty($admin_data['image']))
                                            <img width="80px" src="{{ Storage::url($admin_data['image']) }}"
                                                class="img-fluid img-thumbnail">
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
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
                                            <label class="form-label"> الكلمات المفتاحية <span class='badge badge-danger'>
                                                    افصل بين كل كلمة والاخري ب [ , ] </span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="meta_keywords"
                                                value="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class='btn btn-primary' type='submit'> اضافة فئة جديدة </button>
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
