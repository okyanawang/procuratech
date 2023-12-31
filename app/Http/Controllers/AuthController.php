<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the user input
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Retrieve the user from the database
        $user = User::where('username', $validatedData['username'])
            ->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return redirect()->back()->withErrors(['error' => 'Invalid username or password.']);
        }

        Auth::login($user);

        switch ($user->role) {
            case 'Admin IT':
                return redirect()->route('admin.dashboard');
            case 'Project Manager':
                return redirect()->route('pimpinan.dashboard');
            case 'Supervisor':
                return redirect()->route('supervisor.dashboard');
            case 'Measurement Executor':
                return redirect()->route('pekerja.dashboard');
            case 'Analyst':
                return redirect()->route('pekerja.dashboard');
            case 'Job Executor':
                return redirect()->route('pekerja.dashboard');
            case 'Job Inspector':
                return redirect()->route('pemeriksa.dashboard');
            case 'Inventory Officer':
                return redirect()->route('inventori.dashboard');

                // If the user does not exist or the password is incorrect, redirect back to the login page with an error message
                // return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register_index()
    {
        return view('auth.register');
    }

    public function register()
    {
        return view('admin.staff.register');
    }

    public function staff_register_submit(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'availability_status' => 'required',
            'employement_status' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:5048',

        ]);


        $user = new User;
        $newImageName = time() . '-' . 'staff' . '.' . $request->file('image_path')->extension();
        $request->file('image_path')->move(public_path('staff'), $newImageName);
        $user->name = $validatedData['name'];
        $user->role = $validatedData['role'];
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->address = $validatedData['address'];
        $user->registration_number = mt_rand(100000, 999999);
        $user->availability_status = $validatedData['availability_status'];
        $user->employement_status = $validatedData['employement_status'];
        $user->image_path = $newImageName;
        $user->save();

        // dd($user);
        return redirect()->back()->with('success', 'Register success.');
        // return redirect()->route('admin.staff')->with('success', 'Staff registered successfully!');
    }
}
