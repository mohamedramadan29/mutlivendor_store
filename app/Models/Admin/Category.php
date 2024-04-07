<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    protected $guarded = [];


    // get sections

    public function section()
    {
      return  $this->belongsTo(\App\Models\Admin\Section::class,'section_id');
    }

    // get parent

    public function parentCategory()
    {
        return $this->belongsTo(\App\Models\admin\Category::class,'parent_id')->select('name','id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class,'parent_id')->where('status',1);
    }
}
