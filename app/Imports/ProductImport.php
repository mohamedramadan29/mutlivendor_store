<?php

namespace App\Imports;

use App\Http\Traits\Slug_Trait;
use App\Models\admin\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductImport implements WithHeadingRow,ToCollection
{
    use Slug_Trait;

    public function collection(Collection $row)
    {
        foreach($row as $r){
            Product::create([
                'section_id'=>0,
                'category_id'=>0,
                'brand_id'=>0,
                'admin_id'=>1,
                'vendor_id'=>0,
                'admin_type'=>'Super Admin',
                'name'=>$r['name'],
                'slug'=>$this->CustomeSlug($r['name']),
                'code'=>'0000',
                'price'=>$r['price'],
                'discount'=>0,
                'short_description'=>$r['desc'],
                'description'=>$r['desc'],
                'weight'=>0,
                'image'=>'',
                'is_feature'=>"0",
                'status'=>1
            ]);

        }

    }

//    public function model(array $row)
//    {
//        return new Product([
//            'section_id'=>0,
//            'category_id'=>0,
//            'brand_id'=>0,
//            'admin_id'=>1,
//            'vendor_id'=>0,
//            'admin_type'=>'Super Admin',
//            'name'=>$row['name'],
//            'slug'=>$this->CustomeSlug($row['name']),
//            'code'=>'0000',
//            'price'=>$row['price'],
//            'discount'=>0,
//            'short_description'=>$row['desc'],
//            'description'=>$row['desc'],
//            'weight'=>0,
//            'image'=>$row['image'],
//            'is_feature'=>"0",
//            'status'=>1
//        ]);
//
//    }
}
