<?php

namespace Database\Seeders;

use App\Models\Admin\VendorBankDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorBankData = new VendorBankDetails();
        $vendorBankData->create([
            'vendor_id'=>'1',
            'account_holder_name'=>'Mohamed Ramadan Elsayed',
            'bank_name'=>'Alahly Bank',
            'account_number'=>'1211221',
            'bank_ifsc_code'=>'112211222',
        ]);
    }
}
