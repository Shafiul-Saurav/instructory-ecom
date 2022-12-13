<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLoginStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerStoreRequest;

class RegisterController extends Controller
{
    public function registerPage()
    {
        return view('frontend.pages.auth.register');
    }

    public function loginPage()
    {
        return view('frontend.pages.auth.login');
    }

    public function registerStore(CustomerStoreRequest $request)
    {
        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        //make a credentials array
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //login attempt if success then redirect home

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('customer.dashboard');
        }
    }

    public function loginStore(CustomerLoginStoreRequest $request)
    {
        //make a credentials array
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // login attempt if success then redirect dashboard
        if(Auth::attempt($credentials, $request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('customer/dashboard');
        }

        // return error message
        return back()->withErrors([
            'email' => 'Wrong Credentials found!'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }
}
