<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    use Message_Trait;

    public function index()
    {
        if (Auth::guard('admin')->user()->type == 'vendor') {
            $vendor_id = Auth::guard('admin')->user()->id;
            if (Auth::guard('admin')->user()->status != 1) {
                return redirect('admin/update_vendor/personal')->withErrors('من فضلك اكمل جميع البيانات الخاصه بك  اولا [المعلومات الشخصيه ، بيانات الموقع ، بيانات البنك  ]  وانتظر التفعيل من الاداره ');
            }
            $orders = Order::with(['order_products' => function ($query) use ($vendor_id) {
                $query->where('vendor_id', $vendor_id);
            }])->orderby('id', 'desc')->get();
        } else {
            $orders = Order::with('order_products')->orderby('id', 'desc')->get();
        }
        return view('admin.orders.index', compact('orders'));
    }

    // get order details

    public function order_details($id, Request $request)
    {
        $order_details = Order::with('order_products')->where('id', $id)->first();
        $order_statuss = OrderStatus::where('status', 1)->get();
        return view('admin.orders.order_details', compact('order_details', 'order_statuss'));
    }

    // Update Order Status
    public function update_order_status(Request $request)
    {
        try {
            $status_data = $request->all();
            Order::where('id', $status_data['order_id'])->update(['order_status' => $status_data['order_status']]);
            // Send Order New Status To Email

            // get the order delievery details
            $orderDelivery = Order::select('name', 'mobile', 'email')->where('id', $status_data['order_id'])->first();
            $orderDetails = Order::with('order_products')->where('id',$status_data['order_id'])->first();
            // Send Update Mail
            // Send Activation Email To User
            $email = $orderDelivery['email'];

            $MessageDate = [
                'name' => $orderDelivery['name'],
                "email" => $orderDelivery['email'],
                'mobile' => $orderDelivery['mobile'],
                'new_status' => $status_data['order_status'],
                'order_details'=>$orderDetails,
            ];
            Mail::send('emails.UpdateOrderStatus', $MessageDate, function ($message) use ($email) {
                $message->to($email)->subject(' تحديث الطلب الخاص بك  ');
            });

            return $this->success_message('تم تعديل الحاله بنجاح ');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }

    public function update_item_status(Request $request)
    {
        try {
            $status_data = $request->all();
            OrderProduct::where('id',$status_data['item_id'])->update(['item_status'=>$status_data['order_item_status']]);

            // Send Order New Status To Email
            // get the order id
            $get_order_id = OrderProduct::select('order_id')->where('id',$status_data['item_id'])->first();
            // get the order delievery details
            $orderDelivery = Order::select('name', 'mobile', 'email')->where('id', $get_order_id['order_id'])->first();
            $orderDetails = Order::with('order_products')->where('id',$get_order_id['order_id'])->first();
            // Send Update Mail
            // Send Activation Email To User
            $email = $orderDelivery['email'];

            $MessageDate = [
                'name' => $orderDelivery['name'],
                "email" => $orderDelivery['email'],
                'mobile' => $orderDelivery['mobile'],
                'new_status' => $status_data['order_item_status'],
                'order_details'=>$orderDetails,
            ];
            Mail::send('emails.UpdateOrderStatus', $MessageDate, function ($message) use ($email) {
                $message->to($email)->subject(' تعديل حالة العنصر في الطلب الخاص بك   ');
            });
            return $this->success_message(' تم تعديل حالة المنتج بنجاح  ');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }
}
