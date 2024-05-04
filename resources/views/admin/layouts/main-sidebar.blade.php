<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'admin/dashboard')) }}">
            لوحة التحكم
            {{--            <img--}}
            {{--                src="{{ URL::asset('assets/admin/img/brand/logo.png') }}" class="main-logo" alt="logo">--}}
        </a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/admin/img/brand/logo-white.png') }}" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/admin/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/admin/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @if(!empty(Auth::guard('admin')->user()->image))
                        <img alt="user-img" class="avatar avatar-xl brround"
                             src="{{\Illuminate\Support\Facades\Storage::url(Auth::guard('admin')->user()->image)}}">
                        <span
                            class="avatar-status profile-status bg-green"></span>
                    @else
                        <img alt="user-img" class="avatar avatar-xl brround"
                             src="{{ URL::asset('assets/admin/img/faces/6.jpg') }}"><span
                            class="avatar-status profile-status bg-green"></span>
                    @endif

                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0"> {{Auth::guard('admin')->user()->name}}  </h4>
                    <span class="mb-0 text-muted"> {{Auth::guard('admin')->user()->email}} </span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category"> الرئيسية</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ url('/' . ($page = 'admin/dashboard')) }}">
                    <svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
                    </svg>
                    <span class="side-menu__label">الرئيسية </span></a>
            </li>
            @if(Auth::guard('admin')->user()->type == "vendor")
                <li class="side-item side-item-category"> اعدادات التاجر</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label"> الاعدادات </span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/update_vendor/personal')}}"> البيانات الشخصية </a>
                        </li>
                        <li><a class="slide-item" href="{{url('admin/update_vendor/business')}}"> بيانات الموقع </a>
                        </li>
                        <li><a class="slide-item" href="{{url('admin/update_vendor/bank')}}"> بيانات البنك </a></li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> الأقسام والمنتجات</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  الأقسام والمنتجات  </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/products')}}"> المنتجات </a></li>
                        <li><a class="slide-item" href="{{url('admin/coupons')}}"> كوبونات الخصم  </a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  اداره الطلبات  </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/orders')}}">  الطلبات   </a>
                        </li>
                    </ul>
                </li>
            @else
                {{--             //////////////////////// Admin ///////////////////--}}
                <li class="side-item side-item-category"> الأقسام والمنتجات</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  الأقسام والمنتجات  </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/sections')}}"> الأقسام </a>
                        </li>
                        <li><a class="slide-item" href="{{url('admin/categories')}}"> فئات الأقسام </a></li>
                        <li><a class="slide-item" href="{{url('admin/products')}}"> المنتجات </a></li>
                        <li><a class="slide-item" href="{{url('admin/brands')}}"> العلامات التجارية </a></li>
                        <li><a class="slide-item" href="{{url('admin/coupons')}}"> كوبونات الخصم  </a></li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> المستخدمين  </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  اداره الطلبات  </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/orders')}}">  الطلبات   </a>
                        </li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> المستخدمين  </li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  بيانات المستخدمين  </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/users')}}"> مشاهده المستخدمين  </a>
                        </li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> الاعدادات</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  الاعدادات الشخصية </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/update_admin_password')}}"> تعديل كلمة المرور </a>
                        </li>
                        <li><a class="slide-item" href="{{url('admin/update_admin_details')}}"> تعديل البيانات </a></li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> إعدادات المشرفين</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label"> الاعدادات </span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/admin/admin')}}"> الادمن </a></li>
                        <li><a class="slide-item" href="{{url('admin/admin/subadmins')}}"> المشرفين </a></li>
                        <li><a class="slide-item" href="{{url('admin/admin/vendor')}}"> التجار </a></li>
                        <li><a class="slide-item" href="{{url('admin/admin/all')}}"> مشاهدة الكل </a></li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> إعدادات المستخدمين</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label"> الاعدادات </span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/users')}}"> المستخدمين </a></li>
                        <li><a class="slide-item" href="{{url('admin/subscribers')}}"> المشتركين </a></li>
                    </ul>
                </li>
                <li class="side-item side-item-category"> اعدادات الموقع</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                        </svg>
                        <span class="side-menu__label">  الصفحه الرئيسيه  </span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="{{url('admin/banners')}}"> البانرز </a>
                        </li>
                        <li><a class="slide-item" href="{{url('admin/website_advantage')}}"> مميزات المتجر  </a>
                        <li><a class="slide-item" href="{{url('admin/front_titles')}}"> التحكم في العناوين الرئيسية   </a>
                        <li><a class="slide-item" href="{{url('admin/under_banner')}}"> البانر الاساسي    </a>
                        </li>

                    </ul>
                </li>
            @endif

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
