<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginAdminRequest;
use Illuminate\Http\Request;

class AuthenticateAdminController extends Controller
{
    /**
     * Show the login page for admin.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginPage()
    {
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard.index');
        }

        return view('auth.admin.login');
    }


    /**
     * Handle the login request for admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginAdminRequest $request)
    {
        // Get validated data from the form
        $formData = $request->validated();

        // dd($formData);

        // Extract only the email and password from the validated data
        $credentials = [
            'email' => $formData['email'],
            'password' => $formData['password'],
        ];

        // Debug: Check the credentials being passed (optional)
        // dd($credentials);

        // Attempt login using the admin guard
        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard.index');
        }

        // Return back with error if login fails
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }


    /**
     * Handle the registration request for admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = \App\Models\Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        auth()->guard('admin')->login($admin);

        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Handle the logout request for admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the admin user using the admin guard
        auth()->guard('admin')->logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to the admin login page
        return redirect()->route('admin.login.index');
    }
}
