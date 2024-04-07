<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliveryAddresse extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function deliveryaddress()
    {
        $deliveryAddress = DeliveryAddresse::where('user_id',Auth::user()->id)->get();
        return $deliveryAddress;
    }
}
