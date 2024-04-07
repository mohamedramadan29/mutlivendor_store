<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Http\Traits\Slug_Trait;
use App\Models\Admin\Brand;
use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\Admin\ProductImages;
use App\Models\Admin\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use Message_Trait;
    use Slug_Trait;

    public function index()
    {
        $allproduct = Product::with('section', 'category', 'brand');
        if (Auth::guard('admin')->user()->type == 'vendor'){
            if(Auth::guard('admin')->user()->status != 1){

                 return redirect('admin/update_vendor/personal')->withErrors('من فضلك اكمل جميع البيانات الخاصه بك  اولا [المعلومات الشخصيه ، بيانات الموقع ، بيانات البنك  ]  وانتظر التفعيل من الاداره ');
            }
            $allproduct = $allproduct->where('vendor_id',Auth::guard('admin')->user()->vendor_id);
            $allproduct = $allproduct->get();
        }else{
            $allproduct = $allproduct->get();
        }
        return view('admin.products.index', compact('allproduct'));
    }

    public function add(Request $request)
    {
        // get the current user data

        $user_data = Auth::guard('admin')->user();
//        dd($user_data);
        $user_id = $user_data['id'];
        $user_type = $user_data['type'];
        $vendor_id = $user_data['vendor_id'];

        $allsections = Section::select('id', 'name')->get();
        $allcategory = Category::select('id', 'name')->get();
        $allbrands = Brand::select('id', 'name')->get();

        $categories = Section::with('categories')->get();

        try {


            if ($request->isMethod('post')) {

                $productdata = $request->all();

                $rules = [
                    'category_id' => 'required',
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'price' => 'required|numeric',
                    'description' => 'required',
                    'status' => 'required',
                    'image' => 'image|required|mimes:jpg,png,jpeg,webp',
                ];
                $customeMessage = [
                    'category_id.required' => 'من فضلك حدد  فىه القسم  ',
                    'name.required' => ' من فضلك ادخل اسم المنتج  ',
                    'name.regex' => ' من فضلك ادخل اسم المنتج بشكل صحيح ',
                    'price.required' => ' من فضلك ادخل سعر المنتج  ',
                    'price.numeric' => ' من فضلك ادخل سعر المنتج بشكل صحيح ',
                    'description.required' => ' من فضلك ادخل وصف  المنتج  ',
                    'status.required' => ' من فضلك ادخل حاله  المنتج  ',
                    'image.mimes' =>
                        'من فضلك يجب ان يكون نوع الصورة jpg,png,jpeg,webp',
                    'image.image' => 'من فضلك ادخل الصورة بشكل صحيح',
                ];
                $this->validate($request, $rules, $customeMessage);


                // dd($productdata);
                $product = new Product();
                /// Upload PRODUCT IMAGE
                if ($request->hasFile('image')) {
                    $img_tmp = $request->file('image');
                    if ($img_tmp->isValid()) {
                        $image = $request
                            ->file('image')
                            ->store('public/admin/images/product_images');
                    }
                }
                $categorydata = Category::find($productdata['category_id']);

                $product->section_id = $categorydata['section_id'];
                $product->category_id = $productdata['category_id'];
                $product->brand_id = $productdata['brand_id'];
                $product->admin_id = $user_id;
                $product->vendor_id = $vendor_id;
                $product->admin_type = $user_type;
                $product->name = $productdata['name'];
                $product->slug = $this->CustomeSlug($productdata['name']);
                $product->price = $productdata['price'];
                $product->code = $productdata['code'];
                $product->discount = $productdata['discount'];
                $product->weight = $productdata['weight'];
                $product->description = $productdata['description'];
                $product->status = $productdata['status'];
                $product->is_feature = $productdata['is_feature'];
                $product->best_seller = $productdata['best_seller'];
                $product->meta_title = $productdata['meta_title'];
                $product->meta_description = $productdata['meta_description'];
                $product->meta_keywords = $productdata['meta_keywords'];
                $product->image = $image;
                $product->save();
                return $this->success_message('تم اضافه المنتج بنجاح');
            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }


        return view('admin.products.add', compact('allbrands', 'categories', 'allcategory', 'allsections','user_type'));
    }

    public function update($id, Request $request)
    {
        // get the current user data
        $user_data = Auth::guard('admin')->user();
        $user_id = $user_data['id'];
        $user_type = $user_data['type'];
        $vendor_id = $user_data['vendor_id'];

        $allsections = Section::select('id', 'name')->get();
        $allcategory = Category::select('id', 'name')->get();
        $allbrands = Brand::select('id', 'name')->get();
        $categories = Section::with('categories')->get();
        // get the current product

        $product = Product::where("id", $id)->first();

        try {
            if ($request->isMethod('post')) {

                $productdata = $request->all();

                $rules = [
                    'category_id' => 'required',
                    'name' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                    'status' => 'required',
                    'image' => 'image|mimes:jpg,png,jpeg,webp',
                ];
                // Validate image only if it's being updated
                if ($request->hasFile('image')) {
                    $rules['image'] = 'image|mimes:jpg,png,jpeg,webp';
                }
                $customeMessage = [
                    'category_id.required' => 'من فضلك حدد  فىه القسم  ',
                    'name.required' => ' من فضلك ادخل اسم المنتج  ',
                    'price.required' => ' من فضلك ادخل سعر المنتج  ',
                    'description.required' => ' من فضلك ادخل وصف  المنتج  ',
                    'status.required' => ' من فضلك ادخل حاله  المنتج  ',
                    'image.mimes' =>
                        'من فضلك يجب ان يكون نوع الصورة jpg,png,jpeg,webp',
                    'image.image' => 'من فضلك ادخل الصورة بشكل صحيح',
                ];
                $this->validate($request, $rules, $customeMessage);

                /// Upload PRODUCT IMAGE
                if ($request->hasFile('image')) {
                    $img_tmp = $request->file('image');
                    if ($img_tmp->isValid()) {
                        $image = $request
                            ->file('image')
                            ->store('public/admin/images/product_images');
                        // delete old image
                        if ($product['image'] != '') {
                            Storage::delete($product['image']);
                        }
                        $product->update([
                            'image' => $image
                        ]);
                    }
                }
                $categorydata = Category::find($productdata['category_id']);
                $product->update([
                    "section_id" => $categorydata['section_id'],
                    "category_id" => $productdata['category_id'],
                    "brand_id" => $productdata['brand_id'],
                    "admin_id" => $user_id,
                    "vendor_id" => $vendor_id,
                    "admin_type" => $user_type,
                    "name" => $productdata['name'],
                    'slug'=>  $this->CustomeSlug($productdata['name']),
                    "price" => $productdata['price'],
                    "code" => $productdata['code'],
                    "discount" => $productdata['discount'],
                    "weight" => $productdata['weight'],
                    "description" => $productdata['description'],
                    "status" => $productdata['status'],
                    "is_feature" => $productdata['is_feature'],
                    'best_seller'=>$productdata['best_seller'],
                    "meta_title" => $productdata['meta_title'],
                    "meta_description" => $productdata['meta_description'],
                    "meta_keywords" => $productdata['meta_keywords'],

                ]);
                return $this->success_message('تم تعديل المنتج بنجاح');
            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

        return view('admin.products.edit', compact('product', 'categories', 'allbrands', 'allcategory', 'allsections','user_type'));
    }

// Function To Insert More Images
    // Function To Insert More Images
    public function add_images($id, Request $request)
    {
        try {
            // Find the product by ID
            $product = Product::with('productImages')->findOrFail($id);

            if ($request->isMethod('post')) {
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        if ($image->isValid()) {
                            // Save image paths in the database
                            $imagePath = $image->store('public/admin/images/gallary_product_images');
                            $product->productImages()->create(
                                [
                                    'product_id' => $product,
                                    'image' => $imagePath,
                                    'status' => 1
                                ]
                            );
                        }
                    }
                }

                return $this->success_message('تم إضافة صور لمعرض المنتج بنجاح');
            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

        return view('admin.products.images.add_new_images', compact('product'));
    }
    //delete image from Product gallary
    public function delete_image($id)
    {
        try {
            $productImage = ProductImages::findOrFail($id);
            if ($productImage['image'] != '') {
                Storage::delete($productImage['image']);
            }
            $productImage->delete();
            return $this->success_message('تم حذف المنتج بنجاح');
        }
        catch (\Exception $e){
            return $this->exception_message($e);
        }

    }

    // delete Product

    public function delete($id)
    {
        try {
            $product = Product::findOrFail($id);


            $product->delete();
            return $this->success_message('تم حذف المنتج بنجاح');

        } catch (\Exception $e) {
            return $this->exception_message($e);
        }
    }
}
