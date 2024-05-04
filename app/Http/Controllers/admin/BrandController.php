<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    use Message_Trait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request)
    {
        try {
            $new_brands = $request->all();
            $rules = [
                'name' => 'required|max:50|min:3',
            ];
            $custome_messages = [
                'name.required' => 'من فضلك ادخل اسم البراند ',
                'name.max' => 'اسم القسم يجب ان يكون اقل من 50 حرف ',
                'name.min' => 'من فضلك ادخل اسم القسم بشكل صحيح',
            ];
            $this->validate($request, $rules, $custome_messages);
            if ($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $image = $request->file('image')->store('public/admin/images/brands');
                }
            }
            $brand = new Brand();

            $brand->name = $new_brands['name'];
            $brand->image = $image;
            $brand->status = $new_brands['status'];
            $brand->save();
            return $this->success_message(' تم اضافه علامه تجارية بنجاح ');
        }catch (\Exception $e){
            return $this->exception_message($e);
        }
    }


    public function update(Request $request)
    {
        try {
            $brand_data = $request->all();
            $brand = Brand::where('id', $brand_data['brand_id'])->first();
            $rules = [
                'brand_name' => 'required|max:50|min:3',
            ];
            $custome_messages = [
                'brand_name.required' => 'من فضلك ادخل اسم  العلامة التجارية',
                'brand_name.max' => 'اسم العلامة يجب ان يكون اقل من 50 حرف ',
                'brand_name.min' => 'من فضلك ادخل اسم العلامة بشكل صحيح',
            ];
            $this->validate($request, $rules, $custome_messages);
            if ($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $image = $request->file('image')->store('public/admin/images/brands');
                    // delete old image
                    if ($brand['image'] != '') {
                        Storage::delete($brand['image']);
                    }
                    $brand->update([
                        'image'=>$image,
                    ]);
                }
            }
            $brand->update([
                'name' => $brand_data['brand_name'],
                'status' => $brand_data['brand_status']
            ]);
            return $this->success_message('تم تعديل العلامه بنجاح');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }



    public function delete($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return $this->success_message('تم حذف  العلامة بنجاح');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }
}
