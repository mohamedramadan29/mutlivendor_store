<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Slug_Trait;
use App\Models\admin\Category;
use App\Models\Admin\Section;
use Illuminate\Http\Request;
use App\Http\Traits\Message_Trait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    use Message_Trait;
    use Slug_Trait;

    public function index()
    {
        $allcategories = Category::with('parentCategory', 'section')->get();
        //dd($allcategories);
       return view('admin.categories.index', compact('allcategories'));
    }

    // Add New Category

    public function add(Request $request)
    {
        $new_category = new Category();
        if ($request->isMethod('post')) {
            try {
                $alldata = $request->all();
                // Make Validation
                $rules = [
                    'name' => 'required',
                    'parent_id' => 'required',
                    'section_id' => 'required',
                    'status' => 'required',
                    'image' => 'image|required|mimes:jpg,png,jpeg,webp',
                ];
                $customeMessage = [
                    'name.required' => 'من فضلك ادخل اسم الفئة',
                    'parent_id.required' => 'من فضلك ادخل نوع الفئة',
                    'section_id.required' => 'من فضلك حدد القسم ',
                    'status.required' => 'حدد حالة القسم ',
                    'image.mimes' =>
                        'من فضلك يجب ان يكون نوع الصورة jpg,png,jpeg,webp',
                    'image.image' => 'من فضلك ادخل الصورة بشكل صحيح',
                ];
                $this->validate($request, $rules, $customeMessage);
                /// Upload Admin Photo
                if ($request->hasFile('image')) {
                    $img_tmp = $request->file('image');
                    if ($img_tmp->isValid()) {
                        $image = $request
                            ->file('image')
                            ->store('public/admin/images/category_images');
                    }
                }
                $new_category->name = $alldata['name'];
                $new_category->slug = $this->CustomeSlug($alldata['name']);
                $new_category->parent_id = $alldata['parent_id'];
                $new_category->section_id = $alldata['section_id'];
                $new_category->description = $alldata['description'];
                $new_category->status = $alldata['status'];
                $new_category->meta_title = $alldata['meta_title'];
                $new_category->meta_description = $alldata['meta_description'];
                $new_category->meta_keywords = $alldata['meta_keywords'];
                $new_category->image = $image;
                $new_category->save();
                return $this->success_message('تمت الاضافة بنجاح');
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => $e->getMessage()]);
            }
        }
        // get all category
        $allcats = Category::select('id', 'name')->get();
        // get all sections
        $allsections = Section::select('id', 'name')->get();
        return view('admin.categories.add', compact('allcats', 'allsections'));
    }

    public function update($id, Request $request)
    {
        $category = Category::findOrFail($id); // get all category
        $allcats = Category::select('id', 'name')->get();

        // get all sections
        $allsections = Section::select('id', 'name')->get();
        try {
            if ($request->isMethod('post')) {
                $update_data = $request->all();
                /// Upload Category Image
                if ($request->hasFile('image')) {
                    $img_tmp = $request->file('image');
                    if ($img_tmp->isValid()) {
                        $image = $request
                            ->file('image')
                            ->store('public/admin/images/category_images');
                        // delete old image
                        if ($category['image'] != '') {
                            Storage::delete($category['image']);
                        }
                        $category->update([
                            'image' => $image,
                        ]);
                    }
                }
                $category->update([
                    'name' => $update_data['name'],
                    'slug' => $this->CustomeSlug($update_data['name']),
                    'parent_id' => $update_data['parent_id'],
                    'section_id' => $update_data['section_id'],
                    'description' => $update_data['description'],
                    'status' => $update_data['status'],
                    'meta_title' => $update_data['meta_title'],
                    'meta_description' => $update_data['meta_description'],
                    'meta_description' => $update_data['meta_description'],
                    'meta_keywords' => $update_data['meta_keywords'],
                ]);
                return $this->success_message('تم التعديل بنجاح');
            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

        return view(
            'admin.categories.edit',
            compact('category', 'allcats', 'allsections')
        );
    }

    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category['image'] != '') {
                Storage::delete($category['image']);
            }
            $category->delete();
            return $this->success_message('تم حذف القسم بنجاح');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
