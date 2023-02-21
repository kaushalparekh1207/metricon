<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        $email = $request->input('email');
        $name = User::where('email', $email)->pluck('name')->first();
        $admin_id = User::where('email', $email)->pluck('id')->first();
        // $contact = User::where('username', $username)->pluck('contact')->first();
        $user_data = array(
            'email' => $email,
            'password' => $request->get('password'),
        );

        if (Auth::attempt($user_data, $request->get('remember'))) {

            // Remember Login Details
            if ($request->has('remember')) {
                Cookie::queue('saved_email', $email, 1440);
                Cookie::queue('saved_password', $request->get('password'), 1440);
            }
            $request->session()->put('admin', ['admin_id' => $admin_id, 'name' => $name]);
            return redirect('dashboard');

        } else {
            toastr()->error('Invalid Information');
            return redirect('login');
        }
    }
}
