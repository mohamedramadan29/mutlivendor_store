<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Admin;
use App\Models\admin\Product;
use App\Models\Admin\Vendor;
use App\Models\Admin\VendorBusinessDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    use Message_Trait;

    public function login_register()
    {
        return view('website.vendor_login');
    }

    public function register(Request $request)
    {
        try {
            $all_data = $request->all();
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:admins|unique:vendors',
                'mobile' => 'required|unique:admins|unique:vendors|numeric|min:10',
                'accept' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:8',
//                    'regex:/[a-z]/', // must contain at least one lowercase letter
//                    'regex:/[A-Z]/', // must contain at least one uppercase letter
//                    'regex:/[0-9]/', // must contain at least one digit
//                    'regex:/[!@#$%^&*()_+\-=\[\]{};:\'"\\|,.<>\/?]/', // must contain a special character
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
                'password.min' => 'كلمه المرور يجب ان تكون اكثر من ٨ احرف وتحتوي علي احرف وارقام ورموز ',
                'password.regex' => 'كلمه المرور يجب ان تكون اكثر من ٨ احرف وتحتوي علي احرف وارقام ورموز ',
                'accept.required' => 'يجب الموافقه علي الشروط والاحكام ',
            ];
            $validator = Validator::make($all_data, $rules, $customeMessage);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
            DB::beginTransaction();
            $vendor = new Vendor();
            // Insert In Vendor Table
            $vendor->name = $all_data['name'];
            $vendor->email = $all_data['email'];
            $vendor->mobile = $all_data['mobile'];
            $vendor->save();
            // Insert In Admin Table
            $admin = new Admin();
            $admin->name = $all_data['name'];
            $admin->email = $all_data['email'];
            $admin->mobile = $all_data['mobile'];
            $admin->password = bcrypt($all_data['password']);
            $admin->type = 'vendor';
            $admin->vendor_id = $vendor->id;
            $admin->status = 0;
            $admin->save();
            // Send Confirmation Email
            $email = $all_data['email'];
            $MessageDate = [
                "email" => $all_data['email'],
                'name' => $all_data['name'],
                'code' => base64_encode($email)
            ];
            Mail::send('emails.VendorConfirmation', $MessageDate, function ($message) use ($email) {
                $message->to($email)->subject('Confirm Your Vendor Account');
            });

            DB::commit();


            return $this->success_message('تم التسجيل بنجاح  :: من فضلك فعل الحساب تبعك من خلال البريد الالكتروني ');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }


    }

    public function vendorConfirm($email)
    {
        //decode Vendor email
        $email = base64_decode($email);
        // Check Vendor Email Exist
        $vendorCount = Vendor::where('email', $email)->count();
        if ($vendorCount > 0) {
            // Vendor Account Exist
            // Check  If This Vendor Email Confirmed  Or Not
            $vendorDetails = Vendor::where('email', $email)->first();
            if ($vendorDetails->confirm == 'yes') {
                $message = 'تم تفعيل البريد الالكتروني بالفعل ! سجل دخولك الان ';
                return redirect('vendor/login_register')->with('Error_Message', $message);
            } else {
                // Update Vendor Confrim  Email And Admin Email
                Admin::where('email', $email)->update(['confirm' => 'yes']);
                Vendor::where('email', $email)->update(['confirm' => 'yes']);
                // Send Register Email
                $email = $email;
                $MessageDate = [
                    "email" => $email,
                    'name' => $vendorDetails->name,
                    'mobile' => $vendorDetails->mobile
                ];
                Mail::send('emails.Vendor_confirmed', $MessageDate, function ($message) use ($email) {
                    $message->to($email)->subject(' البريد الالكتروني مفعل بالفعل ');
                });

                // Redirect Vendor To Login/ Regitser Page With Message
                $message = 'تم تفعيل البريد الالكتروني الخاص بك يمكنك تسجيل الدخول الان ';
                return redirect('vendor/login_register')->with('Success_message', $message);
            }
        } else {
            abort(404);
        }
    }

    public function Vendor_products($website_name)
    {
        // get the vendor data
        $vendorBuisnessDetails = VendorBusinessDetails::where('store_website', $website_name)->first();
        $vendor_id = $vendorBuisnessDetails['vendor_id'];
        $vendorDetails = Vendor::where('id', $vendor_id)->first();

        $products = Product::where(['vendor_id'=>$vendor_id,'status'=>1]);
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'latest') {
                $products = $products->orderBy('id', 'Desc');
            } elseif ($_GET['sort'] == 'oldest') {
                $products = $products->orderBy('id', 'Asc');
            } elseif ($_GET['sort'] == 'price_from_low_heigh') {
                $products = $products->orderBy('price', 'Asc');
            } elseif ($_GET['sort'] == 'price_from_hieght_low') {
                $products = $products->orderBy('price', 'Desc');
            }
        }
        $products = $products->paginate(12);


        return view('website.vendor_store', compact('products', 'vendorDetails','vendorBuisnessDetails'));
    }
}
