<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    // make relations
    // section

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
    public function category()
    {
        return $this->belongsTo( Category::class,'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImages::class,'product_id');

    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id')->with('vendorbuisnessdetails');
    }

    // get the product image with id

    public static function getproductImage($productid)
    {
        $getproduct_image = Product::select('image')->where('id',$productid)->first();
        return $getproduct_image['image'];
    }


}
