<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Message_Trait;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Message_Trait;

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function update_user(Request $request)
    {
        try {
            $data = $request->all();
            $user = User::where('id', $data['user_id'])->first();
            $user->status = $data['status'];
            $user->save();
            return $this->success_message('تم تعديل الحاله بنجاح ');
        } catch (\Exception $e) {
            return $this->exception_message($e);
        }

    }
}
