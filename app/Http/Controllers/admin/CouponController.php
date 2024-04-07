<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Admin;
use App\Models\Admin\Brand;
use App\Models\admin\Category;
use App\Models\Admin\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    use Message_Trait;

    public function index()
    {
        if (Auth::guard('admin')->user()->type != 'vendor') {
            $allcoupons = Coupon::all();
        } else {
            $vendor_data = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $vendor_id = $vendor_data['id'];
            $allcoupons = Coupon::where('vendor_id', $vendor_id)->get();
        }

        return view('admin.Coupons.index', compact('allcoupons'));
    }

    public function add_coupon(Request $request)
    {
        // get all users
        $allusers = User::where('status', 1)->get();
        // get all Categories
        $allcategories = Category::where('status', 1)->get();
        // get all brands
        if ($request->isMethod('post')) {
            try {
                $alldata = $request->all();
                $rules = [
                    'categories' => 'required',
                    'users' => 'required',
                    'coupon_code' => 'required',
                    'amount_type' => 'required',
                    'coupon_type' => 'required',
                    'amount' => 'required|numeric',
                    'expire_date' => 'required',
                ];
                $customeMessage = [
                    'categories.required' => 'من فضلك حدد القسم ',
                    'users.required' => 'من فضلك حدد   المستخدمين',
                    'coupon_code.required' => 'من فضلك  ادخل كوبون الخصم  ',
                    'coupon_type.required' => 'من فضلك حدد نوع الخصم ',
                    'amount.required' => 'من فضلك حدد قيمه الخصم ',
                    'amount.numeric' => ' قيمه الخصم يجب ان تكون رقم  ',
                ];
                $validator = Validator::make($alldata, $rules, $customeMessage);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                $new_coupon = new Coupon();
                if (isset($alldata['categories'])) {
                    $categories = implode(',', $alldata['categories']);
                } else {
                    $categories = null;
                }
                if (isset($alldata['users'])) {
                    $users = implode(',', $alldata['users']);
                } else {
                    $users = null;
                }
                if (Auth::guard('admin')->user()->type != 'vendor') {
                    $vendor_id = null;
                } else {
                    $vendor_data = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                    $vendor_id = $vendor_data['id'];
                }
                $new_coupon->vendor_id = $vendor_id;
                $new_coupon->coupon_code = $alldata['coupon_code'];
                $new_coupon->categories = $categories;
                $new_coupon->users = $users;
                $new_coupon->coupon_type = $alldata['coupon_type'];
                $new_coupon->amount_type = $alldata['amount_type'];
                $new_coupon->amount = $alldata['amount'];
                $new_coupon->expire_date = $alldata['expire_date'];
                $new_coupon->status = $alldata['status'];
                $new_coupon->save();
                return $this->success_message('تم اضافه كوبون جديد بنجاح');
            } catch (\Exception $e) {
                return $this->exception_message($e);
            }
        }
        return view('admin.Coupons.add', compact('allusers', 'allcategories'));
    }

    ///////// Update Coupon
    public function update_coupon($id, Request $request)
    {
        $coupon_data = Coupon::findOrFail($id);
        // get all users
        $allusers = User::where('status', 1)->get();
        // get all Categories
        $allcategories = Category::where('status', 1)->get();
        if ($request->isMethod('post')) {
            try {
                $new_data = $request->all();
                $rules = [
                    'categories' => 'required',
                    'users' => 'required',
                    'coupon_code' => 'required',
                    'amount_type' => 'required',
                    'coupon_type' => 'required',
                    'amount' => 'required|numeric',
                    'expire_date' => 'required',
                ];
                $customeMessage = [
                    'categories.required' => 'من فضلك حدد القسم ',
                    'users.required' => 'من فضلك حدد   المستخدمين',
                    'coupon_code.required' => 'من فضلك  ادخل كوبون الخصم  ',
                    'coupon_type.required' => 'من فضلك حدد نوع الخصم ',
                    'amount.required' => 'من فضلك حدد قيمه الخصم ',
                    'amount.numeric' => ' قيمه الخصم يجب ان تكون رقم  ',
                ];
                $validator = Validator::make($new_data, $rules, $customeMessage);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                //dd($new_data);
                if (isset($new_data['categories'])) {
                    $categories = implode(',', $new_data['categories']);
                } else {
                    $categories = null;
                }
                if (isset($new_data['users'])) {
                    $users = implode(',', $new_data['users']);
                } else {
                    $users = null;
                }
                if (Auth::guard('admin')->user()->type != 'vendor') {
                    $vendor_id = null;
                } else {
                    $vendor_data = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                    $vendor_id = $vendor_data['id'];
                }
                $coupon_data->update([
                    'coupon_code' => $new_data['coupon_code'],
                    'categories' => $categories,
                    'users' => $users,
                    'coupon_type' => $new_data['coupon_type'],
                    'amount_type' => $new_data['amount_type'],
                    'amount' => $new_data['amount'],
                    'expire_date' => $new_data['expire_date'],
                    'status' => $new_data['status']
                ]);
                return $this->success_message('تم تعديل الكوبون بنجاح');
            } catch (\Exception $e) {
                return $this->exception_message($e);
            }
        }
        return view('admin.Coupons.edit', compact('coupon_data', 'allusers', 'allcategories'));
    }

    // delete coupon
    public function delete_coupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return $this->success_message('تم  حذف الكوبون بنجاح');
    }
}
