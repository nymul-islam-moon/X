<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateFrontController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function register_store(StoreRegisterRequest $request)
    {
        $formData = $request->validated();

        $formData['password'] = Hash::make($formData['password']);

        DB::beginTransaction();
        try {
            // Create the new user
            $user = User::create($formData);

            // Optional: Log the user in immediately
            auth()->login($user);

            DB::commit();

            return redirect()->route('frontend.home.index')
                ->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Something went wrong. Please try again.'])
                ->withInput();
        }
    }

    public function login_store()
    {
        
    }
}
