<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return view('new_website.payment.index');
    }
}
