<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Product;
use App\Models\Admin\website_advantage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvantageController extends Controller
{
    use Message_Trait;

    public function index(Request $request)
    {
        $website_advantages = website_advantage::all();
        if ($request->isMethod('post')) {
        }
        return view('admin.website_settings.website_advantage', compact('website_advantages'));
    }

    public function add(Request $request)
    {

        try {

            $alldata = $request->all();
            $rules = [
                'title' => 'required',
                'title_en' => 'required',
                'desc' => 'required',
                'desc_en' => 'required',
                'image' => 'required',
            ];
            $messages = [
                'title.required' => 'من فضلك ادخل العنوان ',
                'title_en.required' => 'من فضلك ادخل العنوان باللغة الانجليزية ',
                'desc.required' => 'من فضلك ادخل الوصف',
                'desc_en.required' => 'من فضلك ادخل الوصف باللغة الانجليزية ',
                'image.required' => 'من فضلك ادخل الصورة',
                'image.image' => 'من فضلك حدد صورة بشكل صحيح '
            ];
            $this->validate($request, $rules, $messages);
            $adv = new website_advantage();
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $image = $request->file('image')->store('public/admin/images/advantage_images');
                }
            }
            $adv->title = $alldata['title'];
            $adv->title_en = $alldata['title_en'];
            $adv->desc = $alldata['desc'];
            $adv->desc_en = $alldata['desc_en'];
            $adv->image = $image;
            $adv->save();
            return $this->success_message('تم اضافة ميزة جديدة للمتجر ');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }

    public function edit(Request $request, $id)
    {
        try {

            $alldata = $request->all();
            $adv = website_advantage::findOrFail($id);
            $rules = [
                'title' => 'required',
                'title_en' => 'required',
                'desc' => 'required',
                'desc_en' => 'required',
              // 'image' => 'required',
            ];
            if ($request->hasFile('image')){
                $rules['image'] = 'required';
            }
            $messages = [
                'title.required' => 'من فضلك ادخل العنوان ',
                'title_en.required' => 'من فضلك ادخل العنوان باللغة الانجليزية ',
                'desc.required' => 'من فضلك ادخل الوصف',
                'desc_en.required' => 'من فضلك ادخل الوصف باللغة الانجليزية ',
                'image.required' => 'من فضلك ادخل الصورة',
                'image.image' => 'من فضلك حدد صورة بشكل صحيح '
            ];
            $this->validate($request, $rules, $messages);
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $image = $request->file('image')->store('public/admin/images/advantage_images');

                    if ($adv['image'] !=''){
                        Storage::delete($adv['image']);
                    }
                    $adv->update([
                        'image'=>$image
                    ]);
                }
            }
            $adv->update([
                'title'=>$alldata['title'],
                'title_en'=>$alldata['title_en'],
                'desc'=>$alldata['desc'],
                'desc_en'=>$alldata['desc_en'],
            ]);
            return $this->success_message('تم  التعديل بنجاح  ');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $adv = website_advantage::findOrFail($id);

            $adv->delete();
            return $this->success_message('تم حذف الميرة بنجاح');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }

}
