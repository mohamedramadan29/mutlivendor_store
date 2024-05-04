<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\admin\Product;
use App\Models\Cart;
use App\Models\DeliveryAddresse;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    use Message_Trait;

    public function checkout(Request $request)
    {
        $deliverAddress = DeliveryAddresse::deliveryaddress();
        $cartItems = Cart::getcartitems();
        if (count($cartItems) == 0) {
            return redirect('cart/show')->with('Error_Message', 'لا يوجد منتجات في سله المشتريات ');
        }
        try {
            if ($request->isMethod('post')) {
                $alldata = $request->all();
                $userData = User::where('email', Auth::user()->email)->first();
                $user_id = $userData['id'];
                $rules = [
                    'name' => 'required',
                    'mobile' => 'required|max:12|unique:users,mobile,' . $user_id,
                    'address' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'pincode' => 'required',
                    'paymentmethod' => 'required',
                    'accept' => 'required',
                ];
                $CustomeMessage = [
                    'name.required' => 'من فضلك ادخل الاسم ',
                    'mobile.required' => ' من فضلك ادخل رقم الهاتف  ',
                    'mobile.max' => 'رقم الهاتف يجب الا يتجاوز   12 رقم ',
                    'mobile.unique' => ' رقم الهاتف متواجد من قبل  ',
                    'address.required' => 'من فضلك ادخل العنوان الخاص بك ',
                    'city.required' => 'من فضلك ادخل المدينه ',
                    'country.required' => 'من فضلك ادخل الدوله ',
                    'state.required' => 'من فضلك ادخل الولايه ',
                    'pincode.required' => 'من فضلك ادخل الرمز البريدي',
                    'paymentmethod.required' => ' من فضلك حدد وسيله الدفع  ',
                    'accept.required' => ' يجب الموافقه علي الشروط والاحكام  ',

                ];
                $this->validate($request, $rules, $CustomeMessage);
                $payment_method = $alldata['paymentmethod'];
                if ($payment_method == 'cod') {
                    $payment_method = 'cod';
                    $status = 'new';
                } else {
                    // prepare It
                    $payment_method = 'online';
                    $status = 'pending';
                    return redirect('payment');
                }
                DB::beginTransaction();
                // Fetch Order Total Price
                $total_price = 0;
                foreach ($cartItems as $item) {
                    if ($item['productdata']['discount'] != 0 && $item['productdata']['discount'] != null) {
                        $sub_total = ($item['productdata']['price'] - $item['productdata']['discount']) * $item['quantity'];
                    } else {
                        $sub_total = $item['productdata']['price'] * $item['quantity'];
                    }
                    $total_price = $total_price + $sub_total;
                }
                // Calc Shipping Charges
                $shipping_charges = 0;

                // Calculate Grand Total
                $grand_total = $total_price + $shipping_charges - Session::get('coupon_amount');
                // Insert Grand Total In Session
                Session::put('grand_total', $grand_total);

                /// Insert Order Details
                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->name = $alldata['name'];
                $order->address = $alldata['address'];
                $order->city = $alldata['city'];
                $order->state = $alldata['state'];
                $order->country = $alldata['country'];
                $order->pincode = $alldata['pincode'];
                $order->mobile = $alldata['mobile'];
                $order->email = Auth::user()->email;
                $order->shipping_price = $shipping_charges;
                $order->coupon_code = Session::get('coupon_code');
                $order->coupon_amount = Session::get('coupon_amount');
                $order->order_status = $status;
                $order->payment_method = $payment_method;
                $order->grand_total = $grand_total;
                $order->save();
                $order_id = DB::getPdo()->lastInsertId();
                // Insert Order Product Details
                foreach ($cartItems as $item){
                    //
                    $order_product = new OrderProduct();
                    $order_product->order_id = $order_id;
                    $order_product->user_id = Auth::user()->id;
                    $getproductsdata = Product::select('id','name','vendor_id','admin_id','discount','price')->where('id',$item['productdata']['id'])->first();
                    $order_product->vendor_id = $getproductsdata['vendor_id'];
                    $order_product->admin_id = $getproductsdata['admin_id'];
                    $order_product->product_id = $getproductsdata['id'];
                    $order_product->product_name = $getproductsdata['name'];
                    $order_product->product_discount = $getproductsdata['discount'];
                    $order_product->product_price = $getproductsdata['price'];
                    $order_product->product_qty = $item['quantity'];
                    $order_product->save();
                }
                DB::commit();
                // Insert Order ID In Session
                Session::put('order_id',$order_id);
               return redirect('thanks');
            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

        return view('new_website.checkout', compact('deliverAddress', 'cartItems'));
    }

    // thanks Function
    public function thanks()
    {

        if(Session::has('order_id')){
            // Empty The Cart
            Cart::where('user_id',Auth::user()->id)->delete();
            return view('new_website.thanks');
        }else{
            return redirect('/');
        }

    }
}
