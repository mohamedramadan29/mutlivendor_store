<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories()
    {
        return $this->hasMany(Category::class,'section_id')
            ->where(['parent_id'=>0,'status'=>1])->with('subcategory');
    }
}
