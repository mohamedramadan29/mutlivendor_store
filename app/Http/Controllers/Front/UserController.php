<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Admin;
use App\Models\Admin\Vendor;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use Message_Trait;

    public function login_register()
    {
        return view('new_website.users.user_login');

    }

    public function register(Request $request)
    {
        Db::beginTransaction();
        try {
            $all_data = $request->all();
            // dd($all_data);
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users|max:150',
                'mobile' => 'required|unique:users|numeric|min:10',
//                'accept' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                ],
            ];
            $customeMessage = [
                'name.required' => 'من فضلك ادخل الاسم ',
                'email.required' => 'من فضلك ادخل البريد الالكتروني ',
                'email.email' => 'من فضلك ادخل بريد الكتروني صحيح ',
                'email.unique' => 'البريد الالكتروني مستخدم بالفعل من فضلك ادخل بريد الكتروني اخر ',
                'mobile.required' => 'من فضلك ادخل رقم الهاتف ',
                'mobile.unique' => 'رقم الهاتف مستخدم بالفعل من فضلك ادخل رقم هاتف اخر ',
                'mobile.mobile' => 'من فضلك ادخل رقم هاتف صحيح ',
                'mobile.min' => 'رقم الهاتف يجب ان يكون اكثر من ١٠ ارقام',
                'password.required' => 'من فضلك ادخل رقم الهاتف',
                'password.min' => 'كلمه المرور يجب ان تكون اكثر من ٨ احرف  ',
                'password.regex' => 'كلمه المرور يجب ان تكون اكثر من ٨ احرف  ',
//                'accept.required' => 'يجب الموافقه علي الشروط والاحكام ',
            ];
            $validator = Validator::make($all_data, $rules, $customeMessage);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $user = new User();
            // Insert In User Table

            $user->name = $all_data['name'];
            $user->email = $all_data['email'];
            $user->mobile = $all_data['mobile'];
            $user->password = Hash::make($all_data['password']);
            $user->status = 0;
            $user->save();


            // Send Activation Email To User
            $email = $all_data['email'];

            $MessageDate = [
                'name' => $all_data['name'],
                "email" => $all_data['email'],
                'mobile' => $all_data['mobile'],
                'code' => base64_encode($email)
            ];
            Mail::send('emails.UserActivation', $MessageDate, function ($message) use ($email) {
                $message->to($email)->subject(' تفعيل الحساب الخاص بك  ');
            });
            DB::commit();
            return $this->success_message('تم التسجيل بنجاح  :: من فضلك فعل الحساب تبعك من خلال البريد الالكتروني ');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }

    public function user_login(Request $request)
    {

        if ($request->isMethod('post')) {
            try {
                $all_data = $request->all();
                $rules = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                $customMessage = [
                    'email.required' => 'من فضلك ادخل البريد الإلكتروني',
                    'email.email' => 'من فضلك ادخل بريد الكتوني صحيح',
                    'password.required' => 'من فضلك ادخل كلمة المرور',
                ];
                $validator = Validator::make($all_data, $rules, $customMessage);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                if (Auth::attempt(['email' => $all_data['email'], 'password' => $all_data['password']])) {
                    if (Auth::user()->status == 0) {
                        Auth::logout();
                        return Redirect::back()->withInput()->withErrors(' حسابك غير مفعل من فضلك تواصل مع اداره المتجر  ');
                    }
                    // Update User Cart Put User Id
                    if (!empty(Session::get('session_id'))) {
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update([
                            'user_id' => $user_id
                        ]);
                    }
                    return \redirect('user/profile');
                } else {
                    return Redirect::back()->withInput()->withErrors('لا يوجد حساب بهذه البيانات  ');
                }
            } catch (\Exception $e) {
                return $this->exception_message($e);
            }
        }
        return view('new_website.users.user_login');
    }


    // Active User Email
    public function UserConfirm($email)
    {
        $email = base64_decode($email);
        // check if this email exist in users or not
        $user_details = User::where('email', $email)->first();
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) {
            if ($user_details->status == 1) {
                $message = 'تم تفعيل البريد الالكتروني بالفعل ! سجل دخولك الان ';
                return redirect('user/login_register')->with('Error_Message', $message);
            } else {

                // Update User Status
                User::where('email', $email)->update(['status' => 1]);
                // Redirect User To Login/ Regitser Page With Message
                $message = 'تم تفعيل البريد الالكتروني الخاص بك يمكنك تسجيل الدخول الان ';
                return redirect('user/login_register')->with('Success_message', $message);
            }
        } else {
            abort(404);
        }

    }

    // Update Password

    public function update_password(Request $request)
    {

        if ($request->isMethod('post')) {
            $rules = [
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password'
            ];
            $customeMessage = [
                'old_password.required' => 'من فضلك ادخل كلمه المرور',
                'new_password.required' => 'من فضلك ادخل كلمه المرور الجديده',
                'new_password.min' => 'كلمه المرور يجب ان تكون اكبر من او تساوي 8 ارقام وحروف',
                'confirm_password.required' => ' يجب تاكيد كلمه المرور  ',
                'confirm_password.same' => 'يجب تاكيد كلمه المرور بشكل صحيح',
                //'new_password.confirmed'=>'يجب تاكيد كلمه المرور بشكل صحيح'
            ];
            $this->validate($request, $rules, $customeMessage);

            // Check if the user is authenticated
            if (Auth::check()) {
                $user = Auth::user();
                $user_password = $user->password;
                // Check if the old password matches the current password
                if (Hash::check($request->old_password, $user_password)) {
                    // Update the password
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return $this->success_message('تم تعديل كلمه المرور بنجاح');
                } else {
                    return Redirect::back()->withInput()->withErrors('كلمة المرور القديمة غير صحيحة');
                }
            } else {
                return Redirect::back()->withInput()->withErrors('المستخدم غير مسجل الدخول');
            }
        }

        return view('new_website.users.profile');

    }


    // Forget Password

    public function forgetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $alldata = $request->all();
            // dd($alldata);
            $rules = [
                'email' => 'required|email|exists:users',
            ];
            $customMessage = [
                'email.required' => 'من فضلك ادخل البريد الإلكتروني',
                'email.email' => 'من فضلك ادخل بريد الكتوني صحيح',
                'email.exists' => 'لم يتم تسجيل عنوان البريد الالكتروني من قبل ',
            ];
            $validator = Validator::make($alldata, $rules, $customMessage);
            if ($validator->passes()) {
                $user_details = User::where('email', $alldata['email'])->first();
                // Generate New Password
                $new_password = Str::random(8);
                // Update Password To USer
                DB::beginTransaction();
                User::where('email', $alldata['email'])->update(['password' => Hash::make($new_password)]);
                // Send Mail To User With New Password
                // get the user data
                $userdata = User::where('email', $alldata['email'])->first();
                $email = $userdata['email'];
                $MessageDate = [
                    'name' => $userdata['name'],
                    'email' => $email,
                    'password' => $new_password,
                ];
                Mail::send('emails.User_forget_password', $MessageDate, function ($message) use ($email) {
                    $message->to($email)->subject(' كلمه المرور الجديده الخاصه بك  ');
                });
                DB::commit();
                return $this->success_message('تم ارسال كلمه المرور الجديده الي البريد الالكتروني ');


            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }

        return view('new_website.users.forget_password');
    }

    public function user_profile(Request $request)
    {
        $user = Auth::user()->first();
        if ($request->isMethod('post')) {
            $new_data = $request->all();
            //dd($new_data);
            $userData = User::where('id', Auth::user()->id)->first();
            $user_id = $userData['id'];
            $rules = [
                'name' => 'required',
                'mobile' => 'required|max:12|unique:users,mobile,' . $user_id,
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',
                'pincode' => 'required'

            ];
            $customeMessage = [
                'name.required' => 'من فضلك ادخل الاسم ',
                'mobile.required' => ' من فضلك ادخل رقم الهاتف  ',
                'mobile.max' => 'رقم الهاتف يجب الا يتجاوز   12 رقم ',
                'mobile.unique' => ' رقم الهاتف متواجد من قبل  ',
                'address.required' => 'من فضلك ادخل العنوان الخاص بك ',
                'city.required' => 'من فضلك ادخل المدينه ',
                'country.required' => 'من فضلك ادخل الدوله ',
                'state.required' => 'من فضلك ادخل الولايه ',
                'pincode.required' => 'من فضلك ادخل الرمز البريدي',
            ];
            $this->validate($request, $rules, $customeMessage);
            $userData->update([
                'name' => $new_data['name'],
                'email' => $new_data['email'],
                'mobile' => $new_data['mobile'],
                'address' => $new_data['address'],
                'city' => $new_data['city'],
                'state' => $new_data['state'],
                'country' => $new_data['country'],
                'pincode' => $new_data['pincode'],

            ]);

            return $this->success_message('تم تعديل بياناتك بنجاح ');

        }
        return view('new_website.users.profile',compact('user'));
    }

    public function account_edit(Request $request)
    {
        $user = Auth::user()->first();
        if($request->isMethod('post')){
            $alldata = $request->all();
            $user->update([

            ]);

        }

        return view('new_website.users.account_edit',compact('user'));

    }

    public function user_logout()
    {
        Auth::logout();
        return \redirect('/');
    }
}
