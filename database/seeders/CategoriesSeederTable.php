<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();
        $category->create(['parent_id'=>0, 'section_id'=>1, 'name'=>'ملابس',]);
        $category->create(['parent_id'=>1, 'section_id'=>1, 'name'=>'ملابس رجالي ',]);
        $category->create(['parent_id'=>1, 'section_id'=>1, 'name'=>'ملابس حريمي ',]);
    }
}
