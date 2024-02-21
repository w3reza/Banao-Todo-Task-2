<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function loginCheck(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);


            //dd($request->all());

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()
                ->withErrors([
                    'email' => 'The provided email address is not registered.',
                ])
                 ->withInput();
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ]);
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        } catch (Exception $e) {
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Login failed. ' . $e->getMessage());
        }
    }
}
