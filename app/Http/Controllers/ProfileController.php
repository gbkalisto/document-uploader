<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileRequest;
use App\Services\UserService;

class ProfileController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $profile = Auth::user()->profile;
        return view('users.profile', compact('profile'));
    }

    public function updateProfile(UserProfileRequest $request)
    {
        $fields = $request->validated();
        $this->userService->updateProfile($fields, Auth::user()->id);
        return redirect()->back()->with('success', 'User profile updated.');
    }
}
