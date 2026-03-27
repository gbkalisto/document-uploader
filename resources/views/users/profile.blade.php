@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Header Section --}}
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">User Profile</h2>
                        <p class="text-secondary mb-0 small">
                            {{ $user->profile ? 'Update your existing details' : 'Fill in your details to create a profile' }}
                        </p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary shadow-sm px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        {{-- The route remains the same; the Service Class handles Update vs Create --}}
                        <form action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Profile Picture Section --}}
                            <div class="mb-4 text-center text-md-start">
                                <label for="profile_picture"
                                    class="form-label fw-semibold text-secondary small text-uppercase d-block">
                                    Profile Picture
                                </label>

                                {{-- Show current image if it exists --}}
                                @if ($user->profile && $user->profile->profile_picture)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profile"
                                            class="rounded-circle img-thumbnail shadow-sm"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="small text-muted mt-1">Current Photo</div>
                                    </div>
                                @endif

                                <input type="file" name="profile_picture" id="profile_picture"
                                    class="form-control @error('profile_picture') is-invalid @enderror">
                                <div class="form-text">Accepted: JPG, PNG (Max 2MB)</div>
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="text-muted opacity-25 mb-4">

                            <div class="row">
                                {{-- Phone Number --}}
                                <div class="col-md-6 mb-4">
                                    <label for="phone"
                                        class="form-label fw-semibold text-secondary small text-uppercase">
                                        Name
                                    </label>
                                    <input type="text" name="name" id="name"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                        placeholder="Name" value="{{ old('name', $user->name ?? '') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Date of Birth --}}
                                <div class="col-md-6 mb-4">
                                    <label for="dob"
                                        class="form-label fw-semibold text-secondary small text-uppercase">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email ?? '') }}" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Phone Number --}}
                                <div class="col-md-6 mb-4">
                                    <label for="phone"
                                        class="form-label fw-semibold text-secondary small text-uppercase">
                                        Phone Number
                                    </label>
                                    <input type="text" name="phone" id="phone"
                                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                        placeholder="+1 234 567 890" {{-- Populate if exists, otherwise show old input or empty --}}
                                        value="{{ old('phone', $user->profile->phone ?? '') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Date of Birth --}}
                                <div class="col-md-6 mb-4">
                                    <label for="dob"
                                        class="form-label fw-semibold text-secondary small text-uppercase">
                                        Date of Birth
                                    </label>
                                    <input type="date" name="dob" id="dob"
                                        class="form-control form-control-lg @error('dob') is-invalid @enderror"
                                        value="{{ old('dob', $user->profile->dob ?? '') }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Phone Number --}}
                                <div class="col-md-6 mb-4">
                                    <label for="phone"
                                        class="form-label fw-semibold text-secondary small text-uppercase">
                                        Aadhar Number (Last 4 digit)
                                    </label>
                                    <input type="number" name="aadhar_last_four_digit" id="aadhar_last_four_digit"
                                        class="form-control form-control-lg @error('aadhar_last_four_digit') is-invalid @enderror"
                                        placeholder="XXXXXXXX1478"
                                        value="{{ old('aadhar_last_four_digit', $user->aadhar_last_four_digit ?? '') }}">
                                    @error('aadhar_last_four_digit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Date of Birth --}}
                                <div class="col-md-6 mb-4">
                                    <label for="dob"
                                        class="form-label fw-semibold text-secondary small text-uppercase">
                                        Status
                                    </label>
                                    <input type="text" name="is_active" id="is_active"
                                        class="form-control form-control-lg @error('is_active') is-invalid @enderror"
                                        value="{{ old('is_active', $user->is_active == 1 ? 'Active' : 'Inactive') }}"
                                        disabled>
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="mb-4">
                                <label for="address" class="form-label fw-semibold text-secondary small text-uppercase">
                                    dashboard Address
                                </label>
                                <textarea name="address" id="address" rows="3"
                                    class="form-control form-control-lg @error('address') is-invalid @enderror"
                                    placeholder="Enter your full street address">{{ old('address', $user->profile->address ?? '') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                <button type="reset" class="btn btn-light px-4 me-md-2"> <i
                                        class="bi bi-arrow-clockwise"></i> Reset Changes</button>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                    <i class="bi bi-upload me-2"></i>
                                    {{ $user->profile ? 'Update Profile' : 'Save Profile' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3 border-start border-primary border-4">
                    <p class="small text-muted mb-0">
                        <strong>Security Note:</strong> Only you can see and edit this information. Your data is encrypted
                        and stored securely.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
