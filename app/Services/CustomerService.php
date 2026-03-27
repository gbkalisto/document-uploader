<?php

namespace App\Services;

use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Events\UserRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Document;


class CustomerService
{
    public function getUsers($search = null)
    {
        return User::with('profile')
            ->withCount('documents')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    public function createUser($data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'aadhar_last_four_digit' => $data['aadhar_last_four_digit'],
                'password' => Hash::make($data['password']),
            ]);

            // The Observer will automatically catch the 'profile_picture'
            // from the current Request during this create call.
            $user->profile()->create([
                'phone'   => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'dob'     => $data['dob'] ?? null,
            ]);

            return $user;
        });
    }

    public function editUser($id)
    {
        return User::with('profile')->findOrFail($id);
    }

    public function updateUser($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $user = User::findOrFail($id);

            // Update user
            $userData = [
                'name'  => $data['name'],
                'email' => $data['email'],
                'aadhar_last_four_digit' => $data['aadhar_last_four_digit'],
                'is_active' => $data['is_active']
            ];


            if (!empty($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }

            $user->update($userData);

            // Get or create profile
            $profile = $user->profile ?: new Profile(['user_id' => $user->id]);

            // Handle profile image upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Illuminate\Http\UploadedFile) {

                // Delete old image if exists
                if ($profile->profile_picture) {
                    Storage::disk('public')->delete($profile->profile_picture);
                }

                $file = $data['profile_picture'];

                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('profiles', $fileName, 'public');

                $profile->profile_picture = $path;
            }

            // Fill other fields
            $profile->fill([
                'phone'   => $data['phone'] ?? $profile->phone,
                'address' => $data['address'] ?? $profile->address,
                'dob'     => $data['dob'] ?? $profile->dob,
            ]);

            $profile->save();

            return $user;
        });
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    // update user profile
    public function updateProfile(array $data, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() !== $user->id) {
            abort(403, 'You are not authorized to update this profile.');
        }

        $profileData = [
            'phone'   => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'dob'     => $data['dob'] ?? null,
        ];

        if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Illuminate\Http\UploadedFile) {
            $existingPicture = $user->profile?->profile_picture;

            if ($existingPicture && Storage::disk('public')->exists($existingPicture)) {
                Storage::disk('public')->delete($existingPicture);
            }

            $profileData['profile_picture'] = $data['profile_picture']->store('profiles', 'public');
        }

        // Manually check if profile exists
        $profile = $user->profile;

        if ($profile) {
            // Profile exists — just update it
            $profile->update($profileData);
        } else {
            // No profile yet — create one
            $user->profile()->create($profileData);
        }

        return $user->load('profile');
    }

    public function getDocuments($id)
    {
        return User::findOrFail($id);
    }
}
