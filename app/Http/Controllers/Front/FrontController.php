<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\Admin\banners;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\website_advantage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    use Message_Trait;

    public function index()
    {
        $categories = Category::all();
        $banners = banners::where('status', 1)->get();
        $new_products = Product::orderBy('id', 'Desc')->where('status', 1)->limit(8)->get();
        $best_seller = Product::where(['best_seller' => 1, 'status' => 1])->inRandomOrder()->limit(8)->get();
        $feature_products = Product::where(['is_feature' => 1, 'status' => 1])->inRandomOrder()->limit(8)->get();
        $offer_products = Product::where('discount', '>', 0)->where('status', 1)->inRandomOrder()->limit(8)->get();
        $advantages = website_advantage::all();
//        dd($new_products);
       return view('new_website.index', compact('banners', 'new_products', 'best_seller', 'offer_products', 'feature_products','categories','advantages'));
   // return view('welcome');
    }

    public function shop_page()
    {
        $products = Product::where('status', 1);
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'latest') {
                $products = $products->orderBy('id', 'Desc');
            } elseif ($_GET['sort'] == 'oldest') {
                $products = $products->orderBy('id', 'Asc');
            } elseif ($_GET['sort'] == 'price_from_low_heigh') {
                $products = $products->orderBy('price', 'Asc');
            } elseif ($_GET['sort'] == 'price_from_hieght_low') {
                $products = $products->with(['productImages', 'vendor'])->orderBy('price', 'Desc');
            }
        }
        $products = $products->paginate(12);
        return view('new_website.shop', compact('products'));
    }

    public function Category_link($slug)
    {
        $category_data = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $category_data['id']);
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'latest') {
                $products = $products->orderBy('id', 'Desc');
            } elseif ($_GET['sort'] == 'oldest') {
                $products = $products->orderBy('id', 'Asc');
            } elseif ($_GET['sort'] == 'price_from_low_heigh') {
                $products = $products->orderBy('price', 'Asc');
            } elseif ($_GET['sort'] == 'price_from_hieght_low') {
                $products = $products->orderBy('price', 'Desc');
            }
        }
        $products = $products->paginate(12);
        return view('new_website.category', compact('products', 'category_data'));
    }

    // contact page
    public function contact(Request $request)
    {

        try {
            if ($request->isMethod('post')) {
                $alldata = $request->all();
                $rules = [
                    'name' => 'required|min:1|max:100',
                    'phone' => 'required',
                    'email' => 'email',
                    'subject' => 'required',
                    'message' => 'required|min:20'
                ];
                $customeMessage = [
                    'name.required' => 'من فضلك ادخل الاسم',
                    'name.min' => 'من فضلك ادخل الاسم بشكل صحيح ',
                    'name.max' => 'من فضلك ادخل الاسم بشكل صحيح ',
                    'phone.required' => 'من فضلك دخل رقم الهاتف',
                    'subject.required' => 'من فضلك ادخل عنوان الرساله ',
                    'message.required' => 'من فضلك ادخل رسالتك',
                    'message.min' => 'اقل عدد للرساله 20 حرف'

                ];

                //$this->validate($request, $rules, $customeMessage);
                $validator = Validator::make($alldata, $rules, $customeMessage);
                if ($validator->fails()) {
                    return Redirect::back()->withInput()->withErrors($validator);
                }
                DB::beginTransaction();
                $contact = new Contact();
                $contact->name = $alldata['name'];
                $contact->phone = $alldata['phone'];
                $contact->email = $alldata['email'];
                $contact->subject = $alldata['subject'];
                $contact->message = $alldata['message'];
                $contact->save();

                // Send New Contact Mail To Admin
                $adminMail = "mr319242@gmail.com" ;
                $email = $alldata['email'];
                $phone = $alldata['phone'];
                $name = $alldata['name'];
                $subject = $alldata['subject'];
                $content_message = $alldata['message'];
                $MessageDate = [
                    "email" => $email,
                    'phone'=> $phone,
                    'name' => $name,
                    'subject'=>$subject,
                    'content_message'=>$content_message,
                ];
                Mail::send('emails.ContactMail', $MessageDate, function ($message) use ($adminMail) {
                    $message->to($adminMail)->subject('  رساله تواصل جديدة ');
                });
                DB::commit();
                return $this->success_message('تم ارسال رسالتك بنجاح ');


            }
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

        return view('new_website.contact');

    }
}
