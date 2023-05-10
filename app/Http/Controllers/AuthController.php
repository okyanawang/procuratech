<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        // dd($validatedData['password']);
        // dd(!$user || password_verify($validatedData['password'], $user->password));
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return redirect()->back()->withErrors(['error' => 'Invalid username or password.']);
        }    
        // $user = User::where('username', $validatedData['username'])
        //             ->where('password', Hash::make($validatedData['password']))
        //             ->first();
        // dd($user->role);
        switch ($user->role) {
            case 'Admin IT':
                return redirect()->route('admin.dashboard');
            case 'Pimpinan Proyek':
                return redirect()->route('pimpinan.dashboard');
            case 'Supervisor':
                return redirect()->route('supervisor.dashboard');
            case 'Pelaksana Pengukuran':
                return redirect()->route('pengukuran.dashboard');
            case 'Pelaksana Analisis':
                return redirect()->route('analisis.dashboard');
            case 'Pelaksana Pekerjaan':
                return redirect()->route('pekerjaan.dashboard');
            case 'Pelaksana Pemeriksa Pekerjaan':
                return redirect()->route('pemeriksa.dashboard');
            case 'Bendahara Peralatan':
                return redirect()->route('bendahara.dashboard');
            case 'Petugas Inventori':
                return redirect()->route('inventori.dashboard');

        // If the user does not exist or the password is incorrect, redirect back to the login page with an error message
        // return redirect()->back()->with('error', 'Invalid username or password');
        }
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
            'ActiveOnDuty' => 'required',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'role' => $validatedData['role'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'ActiveOnDuty' => $validatedData['ActiveOnDuty'],
        ]);

        // dd($user);
        return redirect()->back()->with('success', 'All data has been deleted.');
        // return redirect()->route('admin.staff')->with('success', 'Staff registered successfully!');
    }
}
