@extends('admin.layouts.master')
@section('title')
    تعديل كوبون الخصم
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                      تعديل الكوبون  </span>
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
                          action="{{ url('admin/update_coupon/'.$coupon_data['id']) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> كود الخصم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="text" class="form-control" name="coupon_code"
                                                   value="{{$coupon_data['coupon_code']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> حدد الاقسام </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select multiple required class='form-control select2' name='categories[]'>
                                                <option value=""> -- حدد نوع القسم --</option>
                                                <option @if($coupon_data['categories'] == 'all') selected
                                                        @endif value="all"> الكل
                                                </option>
                                                @php
                                                    $coupon_categories = explode(',',$coupon_data['categories']);
                                                @endphp
                                                @foreach ($allcategories as $category)
                                                    <option @if(in_array($category['id'],$coupon_categories)) selected
                                                            @endif value='{{ $category['id'] }}'> {{ $category['name'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> المستخدمين </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select multiple required class='form-control select2' name='users[]'>
                                                <option value=""> -- حدد المتسخدمين --</option>
                                                <option @if($coupon_data['users'] == 'all') selected @endif value="all">
                                                    الكل
                                                </option>
                                                @php $users = explode(',',$coupon_data['users']) @endphp
                                                @foreach ($allusers as $user)
                                                    <option @if(in_array($user['email'],$users)) selected
                                                            @endif value='{{ $user['email'] }}'> {{ $user['email'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> نوع الكوبون </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='coupon_type'>
                                                <option value=""> -- حدد نوع الكوبون --</option>
                                                <option @if($coupon_data['coupon_type'] == 'one') selected
                                                        @endif  value='one'> مره واحده
                                                </option>
                                                <option @if($coupon_data['coupon_type'] == 'multiple') selected
                                                        @endif value='multiple'> اكثر من مره
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> نوع الخصم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='amount_type'>
                                                <option value=""> -- حدد نوع الخصم --</option>
                                                <option @if($coupon_data['amount_type'] == 'fixed') selected
                                                        @endif value='fixed'> خصم ثابت
                                                </option>
                                                <option @if($coupon_data['amount_type'] == 'percentage') selected
                                                        @endif value='percentage'> متغير [ % ]
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> قيمه الخصم </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="number" min="1" class="form-control" name="amount"
                                                   value="{{$coupon_data['amount']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> تاريخ الانتهاء </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input required type="date" class="form-control" name="expire_date"
                                                   value="{{$coupon_data['expire_date']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label"> الحاله </label>
                                        </div>
                                        <div class="col-md-9">
                                            <select required class='form-control select2' name='status'>
                                                <option value=""> -- حدد حالة --</option>
                                                <option @if($coupon_data['status'] == 1) selected @endif value='1'>
                                                    فعال
                                                </option>
                                                <option @if($coupon_data['status'] == 0) selected @endif value='0'> غير
                                                    فعال
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button class='btn btn-primary' type='submit'> تعديل كوبون الخصم</button>
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
