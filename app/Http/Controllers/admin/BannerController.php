<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\Admin\banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    use Message_Trait;
    use Upload_Images;

    public function index()
    {
        $banners = banners::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function add(Request $request)
    {
        try {
            $new_banner = $request->all();
            $banner = new banners();
            $rules = [
                'title' => 'required',
                'sub_title' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg,webp',
                'status' => 'required',
                'link' => 'required'
            ];
            $CustomeMessage = [
                'title.required' => 'من فضلك ادخل العنوان ',
                'sub_title.required' => 'من فضلك ادخل العنوان الفرعي ',
                'image.required' => ' من فضلك ادخل الصوره  ',
                'image.mimes' => ' نوع الصوره يجب ان يكون [jpg,png,jpeg,webp  ] ',
                'status,required' => ' من فضلك حدد حاله البانر',
            ];
            $this->validate($request, $rules, $CustomeMessage);
            /// Upload Banner Image
            if ($request->hasFile('image')) {
                $file_name = $this->saveImage($request->image, public_path('assets/images/banner_images'));

            }
            $banner->title = $new_banner['title'];
            $banner->sub_title = $new_banner['sub_title'];
            $banner->status = $new_banner['status'];
            $banner->link = $new_banner['link'];
            $banner->image = $file_name;
            $banner->save();
            return $this->success_message('تم اضافه البانر بنجاح');


        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }

    // update banners
    public function update(Request $request)
    {
        try {
            $update_banner = $request->all();
            $banner_id = $update_banner['banner_id'];
            //  dd($update_banner);
            $banner = banners::findOrFail($banner_id);

            $rules = [
                'title' => 'required',
                'sub_title' => 'required',
                'status' => 'required',
                'link' => 'required'
            ];
            // Validate image only if it's being updated
            if ($request->hasFile('image')) {
                $rules['image'] = 'image|mimes:jpg,png,jpeg,webp';
            }
            $CustomeMessage = [
                'title.required' => 'من فضلك ادخل العنوان ',
                'sub_title.required' => 'من فضلك ادخل العنوان الفرعي ',
                'image.mimes' => ' نوع الصوره يجب ان يكون [jpg,png,jpeg,webp  ] ',
                'status,required' => ' من فضلك حدد حاله البانر',
            ];
            $this->validate($request, $rules, $CustomeMessage);
            $banner->update([
                'title' => $update_banner['title'],
                'sub_title' => $update_banner['sub_title'],
                'status' => $update_banner['status'],
                'link' => $update_banner['link'],
            ]);
            /// Update Banner Image
            if ($request->hasFile('image')) {
                $file_name = $this->saveImage($request->image, public_path('assets/images/banner_images'));
                    //remove Old Image
                    if ($banner['image'] != '') {
                        unlink('assets/images/banner_images/'.$banner['image']);

                    }
                    $banner->update([
                        'image' => $file_name
                    ]);
            }
            return $this->success_message(' تم تعديل البانر بنجاح ');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }


    }

    // delete banner
    public function delete($id, Request $request)
    {
        try {
            $banner = banners::findOrFail($id);
            if ($banner['image'] != '') {
                Storage::delete($banner['image']);
            }
            $banner->delete();
            return $this->success_message('  تم حذف البانر ');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }
}
