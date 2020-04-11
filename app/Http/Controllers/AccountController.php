<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use SEO;
use Validator;

class AccountController extends Controller {
    public function index() {
        SEO::setTitle('แก้ไขข้อมูล');
        $user = Auth::user();
        return view('app.account', compact('user'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->only(['name', 'email', 'phone']), [
            'name' => 'required|string',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
        ]);
        $validator->sometimes('email', 'unique:users', function ($input) use ($request) {
            return Auth::user()->email !== $request->email;
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(
                $request->except('password')
            );
        }

        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;

        if ($request->is_change_password) {
            $request->validate([
                'old_password' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $current_password = Auth::User()->password;

            if (Hash::check($request->old_password, $current_password)) {
                $user->password = Hash::make($request->password);
            }
        }

        if (!$user->save()) {
            return redirect()->route('account')
                ->withErrors(['error' => __('message.error')])
                ->withInput(
                    $request->except('password', 'old_password')
                );
        }

        return redirect()->route('account')->with([
            'success' => __('message.success'),
        ]);
    }
}
