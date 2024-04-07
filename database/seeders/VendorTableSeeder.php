<?php

namespace Database\Seeders;

use App\Models\Admin\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = new Vendor();
        $vendor->create([
            'name'=>'vendor1',
            'address'=>'damanhour',
            'city'=>'damanhour',
            'state'=>'damanhour state',
            'country'=>'egypt',
            'pincode'=>'123',
            'email'=>'vendor1@gmail.com',
            'mobile'=>'01011641221',
            'status'=>0
        ]);
    }
}
