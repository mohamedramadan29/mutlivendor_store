<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\admin\Category;
use App\Models\Admin\Coupon;
use App\Models\admin\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductReviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    use Message_Trait;

    public function product_details($slug)
    {
        $product = Product::with(['productImages', 'vendor'])->where('slug', $slug)->first();
        $product_id = $product['id'];
        $product_reviews = ProductReviews::where('product_id',$product_id)->get();
        //dd($product);
        $category_data = Category::where('id', $product['category_id'])->first();
        $similarProducts = Product::where(['category_id' => $category_data['id'], 'status' => 1])->where('id', '!=', $product['id'])->orderBy('id', 'Desc')->limit(6)->get();
        return view('new_website.product_details', compact('product', 'category_data', 'similarProducts','product_reviews'));
    }

    ///////// Add To Cart
    public function AddToCart(Request $request)
    {
        $cartData = $request->all();
        Session::forget('coupon_code');
        Session::forget('coupon_amount');
//        dd($cartData);
        // Generate Session Id If Not Exists
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }
        //Check If This Product Already Exist Or Not
        if (Auth::check()) {
            // User Is Login
            $user_id = Auth::user()->id;
            $countProducts = Cart::where(['product_id' => $cartData['product_id'], 'user_id' => $user_id])->count();
        } else {
            // User Not Login
            $user_id = 0;
            $countProducts = Cart::where(['product_id' => $cartData['product_id'], 'session_id' => $session_id])->count();
        }
        if ($countProducts > 0) {

            return redirect()->back()->withErrors('تم اضافه المنتج من قبل الي السله ');
        }
        // Save Product In Cart Tabel
        $item = new Cart();
        $item->session_id = $session_id;
        $item->user_id = $user_id;
        $item->product_id = $cartData['product_id'];
        $item->quantity = $cartData['qty'];
        $item->save();
        return $this->success_message(' تم اضافه المنتج الي السله');
    }

    // Show Cart Items
    public function showCart()
    {
        $cartItems = Cart::getcartitems();
        $item_counts = $cartItems->count();
        // dd($cartItems);
        return view('new_website.shopping_cart', compact('cartItems', 'item_counts'));
    }

    // Update Cart Item Qunatity
    public function cartUpdate(Request $request)
    {
        $alldata = $request->all();
        // Make Update Qunatity
        $cartItems = Cart::getcartitems();
        $item_counts = $cartItems->count();
        Session::forget('coupon_code');
        Session::forget('coupon_amount');
        Cart::where('id', $alldata['cartId'])->update(['quantity' => $alldata['qty']]);
        return response()->json([
            'status' => true,
            'View' => (string)View::make('website.cart_items')->with(compact('cartItems', 'item_counts'))
        ]);
    }

    public function deleteCart(Request $request)
    {
        if ($request->ajax()) {
            $alldata = $request->all();
            Session::forget('coupon_code');
            Session::forget('coupon_amount');
            Cart::where('id', $alldata['cartId'])->delete();
            $cartItems = Cart::getcartitems();
            $item_counts = $cartItems->count();
            return response()->json([
                'View' => (string)View::make('website.cart_items')->with(compact('cartItems', 'item_counts'))
            ]);
        }

    }

    // Start Apply Coupon To Users
    public function apply_coupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Session::forget('coupon_code');
            Session::forget('coupon_amount');
            // dd($data);
            $cartItems = Cart::getcartitems();
            $item_counts = $cartItems->count();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount > 0) {
                // Check Other Coupon Conditions
                // Get the Coupon Data
                $coupondata = Coupon::where('coupon_code', $data['code'])->first();
                // check the code is active or not
                if ($coupondata['status'] == 0) {
                    $message = '  كود الخصم غير فعال ';
                }
                // check if this coupon is expired or not
                $current_date = date("Y-m-d");
                if ($coupondata['expire_date'] < $current_date) {
                    $message = ['لقد انتهي وقت هذا الكود '];
                }
                // Check If This Coupon Single Time
                if ($coupondata->coupon_type == 'one') {
                    // Check In Order Table if Coupon already Availed By User
                    $couponCount = Order::where(['coupon_code' => $coupondata['coupon_code'], 'user_id' => Auth::user()->id])->count();
                    if ($couponCount >= 1) {
                        $message = ' تم استخدام هذا الكود بالفعل من قبل !  ';
                    }
                }

                // Check If this Coupon in selected Categories Or Not All Product
                if ($coupondata['categories'] != 'all') {
                    $catarray = explode(',', $coupondata['categories']);
                    foreach ($cartItems as $key => $item) {
                        if (!in_array($item['productdata']['category_id'], $catarray)) {
                            $message = 'هذا الكود غير متاح مع هذه المنتجات ';
                        }
                    }
                }
                // Check This Code Is Applied For Specific Users Or Not
                if ($coupondata['users'] != 'all') {
                    $users = explode(',', $coupondata['users']);
                    if (!in_array(Auth::user()->email, $users)) {
                        $message = ' هذا الكود غير متاح لك استخدامه  ';
                    }
                }

                // Check If This Code Belongs Vendor Data
                if ($coupondata['vendor_id'] != null) {
                    $vendor_id = $coupondata['vendor_id'];
                    $productIds = Product::where('vendor_id', $vendor_id)->pluck("id");
                    $countProducts = Product::where('vendor_id', $vendor_id)->count();
                    if ($countProducts > 0) {
                        foreach ($cartItems as $item) {
                            if (!in_array($item['productdata']['id'], $productIds->toArray())) {
                                $message = 'هذا الكود غير مخصص لهذا المتجر';
                            }
                        }
                    }
                }
                // Error Message Here
                if (isset($message)) {
                    return response()->json([
                        'status' => 'false',
                        'message' => $message,
                        'View' => (string)View::make('website.cart_items')->with(compact('cartItems', 'item_counts')),
                    ]);
                } else {
                    $total_amount = 0;
                    // Coupon Code Is Correct
                    foreach ($cartItems as $item) {
                        if ($item['productdata']['discount'] != 0 && $item['productdata']['discount'] != null) {
                            $sub_total = ($item['productdata']['price'] - $item['productdata']['discount']) * $item['quantity'];
                        } else {
                            $sub_total = $item['productdata']['price'] * $item['quantity'];
                        }
                        $total_amount = $total_amount + $sub_total;
                    }
                    // Check If The Coupon Type Is Fixed Or Percentage

                    if ($coupondata['amount_type'] == 'fixed') {
                        $couponamount = $coupondata['amount'];
                    } else {
                        $couponamount = $total_amount * ($coupondata['amount'] / 100);
                    }

                    $grand_total = $total_amount - $couponamount;

                    // Add Coupon Code And Amount In Session

                    Session::put('coupon_code', $data['code']);
                    Session::put('coupon_amount', $couponamount);
                    $message = 'تم تطبيق الكوبون بنجاح ';
                    return response()->json([
                        'status' => true,
                        'coupon_amount' => $couponamount,
                        'grand_total' => $grand_total,
                        'message' => $message,
                        'View' => (string)View::make('website.cart_items')->with(compact('cartItems', 'item_counts', 'couponamount', 'grand_total')),
                    ]);
                }

            } else {
                return response()->json([
                    'status' => 'false',
                    'message' => 'كود الخصم غير متاح ',
                    'View' => (string)View::make('website.cart_items')->with(compact('cartItems', 'item_counts')),
                ]);
            }
        }
    }

    // Search Products
    public function searchProduct(Request $request)
    {
        $searchTerm = $request->input('search');
        // استعلام للبحث عن المنتجات التي تحتوي على السلسلة المماثلة لـ $searchTerm في اسمها
        // للحفاظ علي كلمة search في ال url
        $products = Product::where('name', 'like', '%' . $searchTerm . '%')->paginate(12)->withQueryString();
        return view('new_website.search',compact('products'));
    }

    // Product Review
    public function product_review(Request $request)
    {
        $alldata = $request->all();

        $rules = [
            'product_id' => 'required',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'product_review' => 'required',
        ];
        $customeMessage = [
            'product_id.required' => 'من فضلك حدد المنتج ',
            'name.required' => ' من فضلك ادخل الاسم ',
            'product_review.required' => ' من فضلك ادخل التقيم   ',
        ];
        $this->validate($request, $rules, $customeMessage);

        $review = new ProductReviews();
        $review->product_id = $alldata['product_id'];
        $review->name = $alldata['name'];
        $review->email = $alldata['email'];
        $review->comment = $alldata['product_review'];
        $review->star_rating = $alldata['input_rating'];
        $review->save();
        return redirect()->back();
    }
}
