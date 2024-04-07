<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin = new Admin();
       $admin->create([
           'name'=>'mohamed',
           'type'=>'Super Admin',
           'vendor_id'=>0,
           'mobile'=>'01011641221',
           'email'=>'mr319242@gmail.com',
           'password'=>Hash::make('11111111'),
           'image'=>'',
           'status'=>1,
       ]);
    }
}
