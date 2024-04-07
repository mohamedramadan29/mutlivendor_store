<?php

namespace Database\Seeders;

use App\Models\Admin\VendorBusinessDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorDetails = new VendorBusinessDetails();
        $vendorDetails->create([
            'vendor_id'=>'1',
            'store_name'=>'store1',
            'store_address'=>'Damanhour',
            'store_city'=>'Damanhour',
            'store_state'=>'Behera',
            'store_country'=>'Egypt',
            'store_pincode'=>'0101',
            'store_mobile'=>'01011642731',
            'store_website'=>'www.facebook.com',
            'store_email'=>'mr@gmail.com',


        ]);
    }
}
