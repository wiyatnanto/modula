<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Socialite;
use Storage;

class AuthController extends Controller
{
    /**
     * Display login page.
     * @return Renderable
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard'); 
        }
        return view('auth::login');
    }

    /**
     * Display login page.
     * @return Renderable
     */
    public function register()
    {
        if (Auth::check()) {
            return redirect('dashboard'); 
        }
        return view('auth::register');
    }

    /**
     * Display login page.
     * @return Renderable
     */
    public function recover()
    {
        if (Auth::check()) {
            return redirect('dashboard'); 
        }
        return view('auth::recover');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();
        // dd($googleUser);
        if ($user) {
            Storage::disk('local')->put('public/avatar/'.$googleUser->id.'.png', file_get_contents($googleUser->avatar));
            $user->update([
                'name' => $googleUser->name,
                'avatar' => $googleUser->id.'.png'
            ]);
        } else {
            // Storage::disk('local')->put('public/avatar/'.$googleUser->id.'.png', file_get_contents($googleUser->avatar));
            // $user = User::create([
            //     'name' => $googleUser->name,
            //     'email' => $googleUser->email,
            //     'avatar' => $googleUser->id.'.png',
            //     'password' => '-'
            // ]);
            return redirect()->route('register')->with('message', 'Email yang digunakan belum terdaftar');
        }
    
        Auth::login($user);
            
        return redirect('dashboard')->with('message', 'You have Successfully loggedin with Google account');
    }

    public function postLogin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error','Email and password field is required');
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('dashboard')->with('success', 'You have Successfully loggedin');
        }
        return redirect()->route('login')->with('error','Oppes! You have entered invalid credentials');
    }

    public function postRegister(Request $request)
    {   
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // dd($request->input('name'));
 
        $user = User::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'avatar' => '-',
            'password' => Hash::make($request->input('password')),
        ]);

        auth()->login($user);

        return redirect('dashboard')->with('success', 'You have Successfully registered with Google account');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('');
    }
}
