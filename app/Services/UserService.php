<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
use App\Events\UserRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class UserService
{
    public function getUsers()
    {
        return User::orderBy('id', 'desc')
            ->paginate(10);
    }

    public function createUser($data)
    {
        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            event(new UserRegistration($user));
            return $user;
        });
    }

    public function editUser($id)
    {
        return User::with('profile')->findOrFail($id);
    }

    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);

        // 1. Handle Password: Only hash and update if the field is not empty
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Remove password from array if user didn't type a new one
            unset($data['password']);
        }

        // 2. Perform the update
        return $user->update($data);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    // update user profile
    // public function updateProfile(array $data, $id)
    // {
    //     $user = User::findOrFail($id);

    //     if (Auth::id() !== $user->id) {
    //         abort(403, 'You are not authorized to update this profile.');
    //     }

    //     $profileData = [
    //         'phone'   => $data['phone'] ?? null,
    //         'address' => $data['address'] ?? null,
    //         'dob'     => $data['dob'] ?? null,
    //     ];

    //     if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Illuminate\Http\UploadedFile) {
    //         $existingPicture = $user->profile?->profile_picture;

    //         if ($existingPicture && Storage::disk('public')->exists($existingPicture)) {
    //             Storage::disk('public')->delete($existingPicture);
    //         }

    //         $profileData['profile_picture'] = $data['profile_picture']->store('profiles', 'public');
    //     }

    //     // Manually check if profile exists
    //     $profile = $user->profile;

    //     if ($profile) {
    //         // Profile exists — just update it
    //         $profile->update($profileData);
    //     } else {
    //         // No profile yet — create one
    //         $user->profile()->create($profileData);
    //     }

    //     return $user->load('profile');
    // }

    public function updateProfile(array $data, $id)
    {
        // 1. Find user or fail early
        $user = User::findOrFail($id);

        // 2. Authorization Check
        if (Auth::id() !== $user->id) {
            abort(403, 'You are not authorized to update this profile.');
        }

        // 3. Use Transaction for Data Integrity
        return DB::transaction(function () use ($data, $user) {

            // Update Users Table
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'aadhar_last_four_digit' => $data['aadhar_last_four_digit']
            ]);

            $profileData = [
                'phone'   => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'dob'     => $data['dob'] ?? null,
            ];

            // Handle Image Upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Illuminate\Http\UploadedFile) {

                // Delete old picture if it exists
                if ($user->profile && $user->profile->profile_picture) {
                    if (Storage::disk('public')->exists($user->profile->profile_picture)) {
                        Storage::disk('public')->delete($user->profile->profile_picture);
                    }
                }

                // Store new picture
                $profileData['profile_picture'] = $data['profile_picture']->store('profiles', 'public');
            }

            // 4. Update or Create Profile
            // Using updateOrCreate is cleaner than manual if/else
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id], // Match condition
                $profileData              // Data to update or create
            );

            return $user->load('profile');
        });
    }
}
