<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    public function show()
    {
        $profile =  Auth::guard('admin')->user();
        return view('admin.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // 1. Validation
        $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'phone'           => 'nullable|numeric',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password'        => 'nullable|confirmed|min:8', // 'confirmed' looks for password_confirmation
        ]);

        // 2. Prepare Data
        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
        ];

        // 3. Handle Password (Only update if filled)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }


        // 4. Handle Profile Picture
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if it exists to keep storage clean
            if ($admin->profile_picture && Storage::disk('public')->exists($admin->profile_picture)) {
                Storage::disk('public')->delete($admin->profile_picture);
            }

            $file = $request->file('profile_picture');

            // Create a unique name: admin_id + timestamp + random string + extension
            // Example: profile_1_1710696000_a1b2c3.jpg
            $fileName = 'profile_' . $admin->id . '_' . time() . '_' . str()->random(6) . '.' . $file->getClientOriginalExtension();

            // Store with the custom unique name
            $path = $file->storeAs('profile_pictures', $fileName, 'public');

            $data['profile_picture'] = $path;
        }

        // 5. Save and Redirect
        $admin->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }
}
