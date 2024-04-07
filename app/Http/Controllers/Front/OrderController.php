<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders($id = null)
    {
        if(empty($id)){
            $orders = Order::with('order_products')->where('user_id',Auth::user()->id)->orderby('id','desc')->get();
            // dd($orders);
            return view('website.orders.index',compact('orders'));
        }else{
            $order_details = Order::with('order_products')->where("id",$id)->where('user_id',Auth::user()->id)->first();

            return view('website.orders.order_details',compact('order_details'));
        }

    }
}
