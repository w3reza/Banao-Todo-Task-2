<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class RegisterController extends Controller
{



    public function create()
    {
        return view('pages.auth.registration');
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|alpha',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ], [
                'name.required' => 'The name field is required.',
                'name.alpha' => 'The name only contain letters.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'The email has already been taken.',
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least :min characters.',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }


            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),

            ]);
            return redirect()->route('login')->with('success', 'Register successfully Completed.');

        } catch (ValidationException $e) {
            return redirect()
            ->route('register.create')
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Register failed. ' . $e->getMessage());

        }
    }


}
