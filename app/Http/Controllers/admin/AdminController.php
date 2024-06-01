<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Use Trait For Success Or Error Messages
    use Message_Trait;

    public function dashboard()
    {
        $last_orders = Order::orderBy('id','desc')->limit(10)->get();
        return view('admin.dashboard',compact('last_orders'));
    }

    ////////////////////// Login Admin //////////////
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            //            $data = $request->all();
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $customMessage = [
                'email.required' => 'من فضلك ادخل البريد الإلكتروني',
                'email.email' => 'من فضلك ادخل بريد الكتوني صحيح',
                'password.required' => 'من فضلك ادخل كلمة المرور',
            ];
            $this->validate($request, $rules, $customMessage);
            //            $validated = $request->validate([
            //                'email' => 'required|email',
            //                'password' => 'required',
            //            ]);
            $email = $request->email;
            $password = $request->password;

            //            if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            //                return redirect('admin/dashboard');
            //            } else {
            //                $this->Error_message('هناك خطا في كلمة المرور او البريد الإلكتروني');
            //            }
            if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
                if (Auth::guard('admin')->user()->type == 'vendor' && Auth::guard('admin')->user()->confirm == 'no') {
                    $this->Error_message('يجب تفعيل البريد الالكتروني الخاص بك اولا ');
                } elseif (Auth::guard('admin')->user()->type != 'vendor' && Auth::guard('admin')->user()->status == '0') {
                    $this->Error_message(' حساب الادمن الخاص بك غير فعال  ');
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

                //$this->Error_message(' لا يوجد حساب بهذه البيانات  ');
                return Redirect::back()->withInput()->withErrors('لا يوجد حساب بهذه البيانات  ');
            }
        }

        return view('admin.login');
    }

    // check admin password in client side
    public function check_admin_password(Request $request)
    {
        $data = $request->all();
        $old_password = $data['current_password'];
        if (Hash::check($old_password, Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    /////// Update Admin Password /////////////
    public function update_admin_password(Request $request)
    {
        if ($request->isMethod('post')) {

            $request_data = $request->all();
            //check if old password is correct or not
            if (Hash::check($request_data['old_password'], Auth::guard('admin')->user()->password)) {
                // check if the new password == confirm password
                if ($request_data['new_password'] == $request_data['confirm_password']) {
                    $admin_user = Admin::where('id', Auth::guard('admin')->user()->id);
                    $admin_user->update([
                        'password' => bcrypt($request_data['new_password'])
                    ]);
                    $this->success_message('تم تعديل كلمة المرور بنجاح');
                } else {
                    $this->Error_message('يجب تأكيد كلمة المرور بشكل صحيح');
                }
            } else {
                $this->Error_message('كلمة المرو القديمة غير صحيحة');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.settings.update_admin_password', compact('adminDetails'));
    }

    ///////////////// Update Admin Details  //////////
    public function update_admin_details(Request $request)
    {
        $admin_data = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        $id = $admin_data['id'];
        if ($request->isMethod('post')) {
            $all_update_data = $request->all();
            ////////////////////// Make Validation //////////////
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:admins,email,' . $id,
                'mobile' => 'required|numeric|digits_between:8,11',
            ];
            $customeMessage = [
                'name.required' => 'من فضلك ادخل الأسم',
                'name.regex' => 'من فضلك ادخل الأسم بشكل صحيح ',
                'email.required' => 'من فضلك ادخل البريد الألكتروني',
                'email.email' => 'من فضلك ادخل البريد الألكتروني بشكل صحيح',
                'email.unique' => 'هذا البريد الألكتروني موجود من قبل من فضلك ادخل بريد الكتروني جديد',
                'mobile.required' => 'من فضلك ادخل رقم الهاتف',
                'mobile.digits_between' => 'رقم الهاتف يجب ان يكون من 8 الي 11 رقم',
            ];
            $this->validate($request, $rules, $customeMessage);
            /// Upload Admin Photo
            if ($request->hasFile('image')) {

                $img_tmp = $request->file('image');
                if ($img_tmp->isValid()) {
                    $image = $request->file('image')->store('public/admin/images/admin_images');
                    // delete old image
                    if ($admin_data['image'] != '') {
                        Storage::delete($admin_data['image']);
                    }
                    $admin_data->update([
                        'image' => $image,
                    ]);
                }
            }
            $admin_data->update([
                'name' => $all_update_data['name'],
                'email' => $all_update_data['email'],
                'mobile' => $all_update_data['mobile'],

            ]);
            $this->success_message('تم تحديث البيانات بنجاح');
            //            return redirect()->back()->with(['Success_message'=>'']);
        }
        return view('admin.settings.update_admin_data', compact('admin_data'));
    }

    ////////////////// View Admins , Sub Admins , Vendors
    ///
    ///
    public function admins($type = null)
    {
        if ($type != null) {
            $admins = Admin::where('type', $type)->get();
            $title = ucfirst($type);
        }
        if ($type == 'all') {
            $admins = Admin::all();
            $title = 'مشاهدة الكل ';
        }
        //        dd($admins);
        return view('admin.admins.admins', compact('admins', 'title'));
    }
    /////////////////// Logout Admin /////////////////////
    ///
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
