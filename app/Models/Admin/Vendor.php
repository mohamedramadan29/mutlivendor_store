<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function vendorbuisnessdetails()
    {
        return $this->belongsTo(VendorBusinessDetails::class,'id','vendor_id');
    }
}
