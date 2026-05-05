<?php

namespace App\Http\Controllers;

use App\Models\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserRegistrationController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserRegistration::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cnic', 'like', "%{$search}%");
        }

        $users = $query->paginate(10);

        return view('user_registrations.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_registrations',
            'cnic' => 'required|string|max:255|unique:user_registrations',
            'telephone' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            $data['profile_picture'] = str_replace('public/', '', $path);
        }

        UserRegistration::create($data);

        return redirect()->route('users.index')->with('success', 'User registered successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = UserRegistration::findOrFail($id);
        return view('user_registrations.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = UserRegistration::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_registrations,email,'.$user->id,
            'cnic' => 'required|string|max:255|unique:user_registrations,cnic,'.$user->id,
            'telephone' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('profile_picture');

        if ($request->hasFile('profile_picture')) {
            // Delete old picture
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            $data['profile_picture'] = str_replace('public/', '', $path);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = UserRegistration::findOrFail($id);
        
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
