<?php

namespace Database\Seeders;

use App\Models\Admin\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections  = new Section();
        $sections->create(['name'=>'ملابس', 'status'=>1,]);
        $sections->create(['name'=>'الكترونيات', 'status'=>0,]);
        $sections->create(['name'=>'عطور', 'status'=>1,]);
    }
}
