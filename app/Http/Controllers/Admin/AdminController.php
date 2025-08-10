<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentAdminId = auth('admin')->id();
        $admins = Admin::where('id', '!=', $currentAdminId)->paginate(5);

        return view('admin.users.index', compact('admins'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {

        DB::beginTransaction();
        try {
            $formData = $request->validated();
            $formData['password'] = Hash::make('pA$$W0rd');

            Admin::create($formData);

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', 'Admin User created successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            // Optional: log the actual error
            Log::error('Admin User creation failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the admin user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $user)
    {
        DB::beginTransaction();

        try {
            $user->delete();
            DB::commit();

            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            DB::rollBack();

            // Optional: log the actual error
            Log::error('Admin User deletion failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong while deleting the admin user.');
        }
    }
}
