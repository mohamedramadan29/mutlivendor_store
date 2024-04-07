<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Section;
use Illuminate\Http\Request;
class SectionController extends Controller
{
    use Message_Trait;

    public function sections()
    {
        $sections = Section::all();
        return view('admin.sections.sections', compact('sections'));
    }

    public function add_section(Request $request)
    {
        try {
            $new_section = $request->all();
            $rules = [
                'name' => 'required|max:50|min:3',
            ];
            $custome_messages = [
                'name.required' => 'من فضلك ادخل اسم القسم ',
                'name.max' => 'اسم القسم يجب ان يكون اقل من 50 حرف ',
                'name.min' => 'من فضلك ادخل اسم القسم بشكل صحيح',
            ];
            $this->validate($request, $rules, $custome_messages);
            $section = new Section();
            $section->name = $new_section['name'];
            $section->status = $new_section['status'];
            $section->save();
            return $this->success_message('تم اضافة قسم جديد بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_section(Request $request)
    {
        try {


            $section_data = $request->all();
            $section = Section::where('id', $section_data['section_id'])->first();
            $rules = [
                'section_name' => 'required|max:50|min:3',
            ];
            $custome_messages = [
                'section_name.required' => 'من فضلك ادخل اسم القسم ',
                'section_name.max' => 'اسم القسم يجب ان يكون اقل من 50 حرف ',
                'section_name.min' => 'من فضلك ادخل اسم القسم بشكل صحيح',
            ];
            $this->validate($request, $rules, $custome_messages);
            $section->update([
                'name' => $section_data['section_name'],
                'status' => $section_data['section_status']
            ]);
            return $this->success_message('تم تعديل القسم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }

    public function delete_section($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->delete();
            return $this->success_message('تم حذف القسم بنجاح');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
