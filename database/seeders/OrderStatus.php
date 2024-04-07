<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order_status = new \App\Models\OrderStatus();
        $order_status->create(['name'=>'new', 'status'=>1]);
        $order_status->create(['name'=>'pending', 'status'=>1]);
        $order_status->create(['name'=>'cancelled', 'status'=>1]);
        $order_status->create(['name'=>'InProgress', 'status'=>1]);
        $order_status->create(['name'=>'Shipped', 'status'=>1]);
        $order_status->create(['name'=>'Partially Shipped', 'status'=>1]);
        $order_status->create(['name'=>'Delivered', 'status'=>1]);
        $order_status->create(['name'=>'Partially Delivered', 'status'=>1]);
        $order_status->create(['name'=>'Paid', 'status'=>1]);

    }
}
