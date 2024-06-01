<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Upload_Images;
use App\Models\Admin\under_banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnderBannerController extends Controller
{
    use Message_Trait;
    use Upload_Images;
    public function index()
    {
        $banners = under_banner::all();
        return view('admin.website_settings.under_banner.index',compact('banners'));
    }
    public function edit(Request $request)
    {
        try {
            $update_banner = $request->all();
            $banner_id = $update_banner['banner_id'];
            //  dd($update_banner);
            $banner = under_banner::findOrFail($banner_id);
            $rules = [
                'title' => 'required',
                'sub_title' => 'required',
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
            ];
            $this->validate($request, $rules, $CustomeMessage);
            $banner->update([
                'title' => $update_banner['title'],
                'title_en' => $update_banner['title_en'],
                'sub_title' => $update_banner['sub_title'],
                'sub_title_en' => $update_banner['sub_title_en'],
                'link' => $update_banner['link'],
                'button_text' => $update_banner['button_text'],
                'button_text_en' => $update_banner['button_text_en'],
            ]);
            /// Update Banner Image
            if ($request->hasFile('image')) {
                $file_name = $this->saveImage($request->image, public_path('assets/images/under_banner'));

                    //remove Old Image
                    if ($banner['image'] != '') {
                        unlink('assets/images/under_banner/'.$banner['image']);
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
}
