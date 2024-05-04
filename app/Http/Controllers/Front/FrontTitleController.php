<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\FrontTitle;
use Illuminate\Http\Request;

class FrontTitleController extends Controller
{
    use Message_Trait;

    public function index()
    {
        $titles = FrontTitle::all();
        return view('admin.website_settings.front_titles.index', compact('titles'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $alldata = $request->all();
            $rules = [
                'title' => 'required',
                'title_en' => 'required',
                'desc' => 'required',
                'desc_en' => 'required',
            ];
            $messages = [
                'title.required' => 'من فضلك ادخل العنوان ',
                'title_en.required' => 'من فضلك ادخل العنوان  باللغة الانجليزية ',
                'desc.required' => 'من فضلك ادخل الوصف  ',
                'desc_en.required' => 'من فضلك ادخل الوصف باللغة الانجليزية  ',
            ];
            $this->validate($request, $rules, $messages);
            $title = FrontTitle::findOrFail($id);
            $title->update([
                'title' => $alldata['title'],
                "title_en" => $alldata['title_en'],
                'desc' => $alldata['desc'],
                "desc_en" => $alldata['desc_en'],
            ]);
            return $this->success_message('تم التعديل بنجاح');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }


    }
}
