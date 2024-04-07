<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $order_statuss = OrderStatus::where('status',1)->get();
        return view('admin.orders.order_details', compact('order_details','order_statuss'));
    }

    // Update Order Status
    public function update_order_status(Request $request)
    {
        $status_data = $request->all();
//        dd($status_data);
        Order::where('id',$status_data['order_id'])->update(['order_status'=>$status_data['order_status']]);
        return $this->success_message('تم تعديل الحاله بنجاح ');
    }
}
