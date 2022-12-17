<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    /**
     * Login screen
     * 
     * @author thanh.clg
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * handle login submit
     * 
     * @author thanh.clg
     * @param Request $request
     */
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Sign in');
        }

        return redirect('login')->withErrors('Login details are not valid');
    }

    /**
     * Registration screen
     * 
     * @author thanh.clg
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * handle registration submit
     * 
     * @author thanh.clg
     * @param Request $request
     */
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('dashboard')->withSuccess('You have sign in.');
    }

    /**
     * Sign out
     * 
     * @author thanh.clg
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    /**
     * Create user
     * 
     * @author thanh.clg
     * @param array $data
     */
    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
