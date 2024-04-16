<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Slug_Trait;
use App\Models\Admin\Admin;
use App\Models\admin\Vendor;
use App\Models\admin\VendorBankDetails;
use App\Models\admin\VendorBusinessDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class VendorController extends Controller
{
    // Use Trait For Success Or Error Messages
    use Message_Trait;
    use Slug_Trait;

    public function update_vendor($slug, Request $request)
    {
        $admin_data = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        $vendor_id = $admin_data['vendor_id'];
        $vendor_id_admin = $admin_data['id'];
        $vendor_person_data = Vendor::where('id', $vendor_id)->first();
        if ($slug == 'personal') {
            if ($request->isMethod('post')) {
                $personal_data = $request->all();
                try {
                    // Update In Admin Table
                    ////////////////////// Make Validation //////////////
                    $rules = [
                        'name' => 'required|regex:/^[\pL\s\-]+$/u',
                        'address' => 'required',
                        'city' => 'required|regex:/^[\pL\s\-]+$/u',
                        'state' => 'required',
                        'country' => 'required|regex:/^[\pL\s\-]+$/u',
                        'pincode' => 'required',
                        'email' => 'required|email|unique:admins,email,' . $vendor_id_admin . '|unique:vendors,email,' . $vendor_id,
                        'mobile' => 'required|numeric|digits_between:8,11',
                    ];
                    $customeMessage = [
                        'name.required' => 'من فضلك ادخل الأسم',
                        'name.regex' => 'من فضلك ادخل الأسم بشكل صحيح ',
                        'address.required' => 'من فضلك ادخل العنوان',
                        'city.required' => 'من فضلك ادخل المدينة ',
                        'state.required' => 'من فضلك ادخل الولاية ',
                        'country.required' => 'من فضلك ادخل الدولة',
                        'country.regex' => 'من فضلك ادخل الدولة بشكل صحيح ',
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
                            $image = $request->file('image')->store('public/admin/images/vendor_images');
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
                        'name' => $personal_data['name'],
                        'email' => $personal_data['email'],
                        'mobile' => $personal_data['mobile'],

                    ]);
                    // Update In Vendor Table
                    $vendor_person_data->update([
                        'name' => $personal_data["name"],
                        'address' => $personal_data["address"],
                        'city' => $personal_data["city"],
                        'state' => $personal_data["state"],
                        'country' => $personal_data["country"],
                        'pincode' => $personal_data["pincode"],
                        'mobile' => $personal_data["mobile"],
                        'email' => $personal_data["email"],
                    ]);
                    $this->success_message('تم تحديث البيانات بنجاح');
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors([$e->getMessage()]);
                }


            }
            return view('admin.settings.update_vendor_details', compact('slug', 'admin_data', 'vendor_person_data'));
        } elseif ($slug == 'business') {

            $store_details_count = VendorBusinessDetails::where('vendor_id', $vendor_id)->count();
            if ($store_details_count > 0) {
                $store_details = VendorBusinessDetails::where('vendor_id', $vendor_id)->first();
                $store_id = $store_details['id'];
//                $rules = [
//                    'store_email' => 'required|email|unique:vendor_business_details,store_email,' . $store_id,
//                ];
//                $customeMessage = [
//                    'store_email.unique' => 'هذا البريد الألكتروني موجود من قبل من فضلك ادخل بريد الكتروني جديد',
//                ];
            } else {
                $store_details = null;
            }

            if ($request->isMethod('post')) {

                try {
                    ////////////////////// Make Validation //////////////
                    $rules = [
                        'store_name' => 'required|regex:/^[\pL\s\-]+$/u',
                        'store_address' => 'required',
                        'store_city' => 'required|regex:/^[\pL\s\-]+$/u',
                        'store_state' => 'required',
                        'store_country' => 'required|regex:/^[\pL\s\-]+$/u',
                        'store_pincode' => 'required',
                        'store_mobile' => 'required|numeric|digits_between:8,11',
                    ];
                    if (isset($store_id) && $store_id != null) {
                        $rules['store_email'] = 'required|email|unique:vendor_business_details,store_email,' . $store_id;
                    } else {
                        $rules['store_email'] = 'required|email|unique:vendor_business_details';

                    }
                    $customeMessage = [
                        'store_name.required' => 'من فضلك ادخل الأسم',
                        'store_name.regex' => 'من فضلك ادخل الأسم بشكل صحيح ',
                        'store_address.required' => 'من فضلك ادخل العنوان',
                        'store_city.required' => 'من فضلك ادخل المدينة ',
                        'store_state.required' => 'من فضلك ادخل الولاية ',
                        'store_country.required' => 'من فضلك ادخل الدولة',
                        'store_country.regex' => 'من فضلك ادخل الدولة بشكل صحيح ',
                        'store_email.required' => 'من فضلك ادخل البريد الألكتروني',
                        'store_email.email' => 'من فضلك ادخل البريد الألكتروني بشكل صحيح',
                        'store_email.unique' => 'هذا البريد الألكتروني موجود من قبل من فضلك ادخل بريد الكتروني جديد',
                        'store_mobile.required' => 'من فضلك ادخل رقم الهاتف',
                        'store_mobile.digits_between' => 'رقم الهاتف يجب ان يكون من 8 الي 11 رقم',
                        'store_pincode.required' => 'من فضلك ادخل الرمز البريدي',
                    ];
                    $this->validate($request, $rules, $customeMessage);
                    $store_update_data = $request->all();
                    if ($store_details_count > 0) {
                        /// Upload Site Logo
                        if ($request->hasFile('store_logo')) {
                            $img_tmp = $request->file('store_logo');
                            if ($img_tmp->isValid()) {
                                $image = $request->file('store_logo')->store('public/admin/images/store_logo');
                                // delete old image
                                if ($store_details['store_logo'] != '') {
                                    Storage::delete($store_details['store_logo']);
                                }
                                $store_details->update([
                                    'store_logo' => $image,
                                ]);
                            }
                        }
                        $store_details->update([
                            'store_name' => $store_update_data['store_name'],
                            'store_website' => $this->CustomeSlug($store_update_data['store_name']),
                            'store_address' => $store_update_data['store_address'],
                            'store_city' => $store_update_data['store_city'],
                            'store_state' => $store_update_data['store_state'],
                            'store_country' => $store_update_data['store_country'],
                            'store_pincode' => $store_update_data['store_pincode'],
                            'store_mobile' => $store_update_data['store_mobile'],
                            'store_email' => $store_update_data['store_email'],

                        ]);
                        $this->success_message('تم تحديث بيانات المتجر بنجاح');
                    } else {

                        // Insert New Data
                        $store_data = new VendorBusinessDetails();
                        ///  Insert Store Logo
                        if ($request->hasFile('store_logo')) {
                            $img_tmp = $request->file('store_logo');
                            if ($img_tmp->isValid()) {
                                $image = $request->file('store_logo')->store('public/admin/images/store_logo');
                            }
                        }
                        $store_data->vendor_id = $vendor_id;
                        $store_data->store_name = $store_update_data['store_name'];
                        $store_data->store_website = $this->CustomeSlug($store_update_data['store_name']);
                        $store_data->store_address = $store_update_data['store_address'];
                        $store_data->store_city = $store_update_data['store_city'];
                        $store_data->store_state = $store_update_data['store_state'];
                        $store_data->store_country = $store_update_data['store_country'];
                        $store_data->store_pincode = $store_update_data['store_pincode'];
                        $store_data->store_mobile = $store_update_data['store_mobile'];
                        $store_data->store_email = $store_update_data['store_email'];
                        $store_data->store_logo = $image;
                        $store_data->save();
                        $this->success_message('تم تحديث بيانات المتجر بنجاح');
                    }

                } catch (\Exception $e) {
                    return redirect()->back()->withErrors([$e->getMessage()]);
                }
            }
            return view('admin.settings.update_vendor_details', compact('slug', 'admin_data', 'vendor_person_data', 'store_details'));
        } elseif ($slug == 'bank') {
            $vendor_bank_count = VendorBankDetails::where('vendor_id', $vendor_id)->count();
            if($vendor_bank_count > 0){
                $vendor_bank_details = VendorBankDetails::where('vendor_id', $vendor_id)->first();
                $id = $vendor_bank_details['id'];
            }else{
                $vendor_bank_details = null;
            }
            if ($request->isMethod('post')) {
                $bank_details = $request->all();
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
//                    'account_number' => 'required|numeric|unique:vendor_bank_details,account_number,' . $id,
                    'bank_ifsc_code' => 'required',
                ];
                if(isset($id) && $id != null){
                    $rules['account_number'] = 'required|numeric|unique:vendor_bank_details,account_number,' . $id;
                }else{
                    $rules['account_number'] = 'required|numeric|unique:vendor_bank_details';
                }
                $customeMessage = [
                    'account_holder_name.required' => 'من فضلك ادخل اسم الحساب ',
                    'account_holder_name.regex' => ' من فضلك ادخل اسم الحساب بشكل صحيح',
                    'bank_name.required' => 'من فضلك ادخل اسم البنك ',
                    'account_number.required' => 'من فضلك ادخل رقم الحساب ',
                    'bank_ifsc_code.required' => 'من فضلك ادخل كود ifsc ',
                    'account_number.unique' => 'من فضلك ادخل رقم الحساب الخاص بك وتأكد منه ',
                    'account_number.numeric' => 'رقم الحساب يجب ان يكون أرقام فقط',
                ];
                $this->validate($request, $rules, $customeMessage);
                if($vendor_bank_count > 0){
                    $vendor_bank_details->update([
                        'account_holder_name' => $bank_details['account_holder_name'],
                        'bank_name' => $bank_details['bank_name'],
                        'account_number' => $bank_details['account_number'],
                        'bank_ifsc_code' => $bank_details['bank_ifsc_code'],
                    ]);
                    return $this->success_message('تم تعديل البيانات بنجاح');
                }else{
                    $vendor_bank = new VendorBankDetails();
                    $vendor_bank->vendor_id = $vendor_id;
                    $vendor_bank->account_holder_name = $bank_details['account_holder_name'];
                    $vendor_bank->bank_name = $bank_details['bank_name'];
                    $vendor_bank->account_number = $bank_details['account_number'];
                    $vendor_bank->bank_ifsc_code = $bank_details['bank_ifsc_code'];
                    $vendor_bank->save();
                    return $this->success_message('تم تعديل البيانات بنجاح');
                }

            }
            return view('admin.settings.update_vendor_details', compact('slug', 'admin_data', 'vendor_bank_details'));
        }

    }

    // View Vendor Details
    public function view_vendor_details($id, Request $request)
    {
        try {
            if ($vendor_data_in_admin = Admin::where('vendor_id', $id)->first()) {
                if ($request->isMethod('post')) {

                    $update_data = $request->all();
                    $vendor_data_in_admin->update([
                        'status' => $update_data['person_status']
                    ]);
                    if($update_data['person_status'] == 1){
                        // Send Confirmation Email
                        $email = $vendor_data_in_admin['email'];
                        $MessageDate = [
                            "email" => $vendor_data_in_admin['email'],
                            'name' => $vendor_data_in_admin['name'],
                        ];
                        Mail::send('emails.VendorChangeStatus', $MessageDate, function ($message) use ($email) {
                            $message->to($email)->subject(' تم تفعيل الحساب الخاص بك كتاجر علي المنصه يمكنك نشر المنتجات الخاصه بك الان  ');
                        });
                    }
                    return $this->success_message('تم تعديل حالة التاجر بنجاح ');

                }
                $vendor_person_data = Vendor::where('id', $id)->first();
                $store_details = VendorBusinessDetails::where('vendor_id', $id)->count();
                if ($store_details > 0) {
                    $store_details = VendorBusinessDetails::where('vendor_id', $id)->first();
                } else {
                    $store_details = null;
                }

                $vendor_bank_details = VendorBankDetails::where('vendor_id', $id)->count();
                if ($vendor_bank_details > 0) {
                    $vendor_bank_details = VendorBankDetails::where('vendor_id', $id)->first();
                } else {
                    $vendor_bank_details = null;
                }
                return view('admin.admins.view_vendor_details', compact('vendor_person_data', 'vendor_data_in_admin', 'store_details', 'vendor_bank_details'));
            }
            return view('admin.404');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
   public function update_vendor_commission(Request $request)
   {
       try {
           $commision_data = $request->all();
           $vendor = Vendor::where('id',$commision_data['vendor_id'])->first();
           $vendor->update([
               'commission'=>$commision_data['commission'],
           ]);
           return $this->success_message('تم تحديث العمولة بنجاح');
       }catch (\Exception $e){
           return $this->exception_message($e);
       }



   }
}
