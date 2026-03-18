@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Catalog</h6>
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h3 fw-extrabold mb-0">Edit Customer</h2>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">ID: #{{ $user->id }}</span>
                </div>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-white shadow-sm px-3">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-4 px-4 border-0">
                        <h5 class="mb-0 fw-bold">Update Profile Details</h5>
                        <small class="text-muted">Modify information for <strong>{{ $user->name }}</strong> below.</small>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.customers.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control bg-light @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control bg-light @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Phone Number</label>
                                    <input type="text" name="phone" class="form-control bg-light @error('phone') is-invalid @enderror" value="{{ old('phone', $user->profile->phone ?? '') }}">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control bg-light @error('dob') is-invalid @enderror" value="{{ old('dob', $user->profile->dob ?? '') }}">
                                    @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-muted"></i></span>
                                        <input type="password" name="password" class="form-control bg-light @error('password') is-invalid @enderror" placeholder="Leave blank to keep current">
                                    </div>
                                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Confirm New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock text-muted"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control bg-light" placeholder="Repeat new password">
                                    </div>
                                    <small class="text-muted mt-1 d-block">Only fill these if you want to change the password.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Profile Picture</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($user->profile && $user->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" class="rounded-3 shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                                <i class="bi bi-person fs-4"></i>
                                            </div>
                                        @endif
                                        <input type="file" name="profile_picture" class="form-control bg-light @error('profile_picture') is-invalid @enderror">
                                    </div>
                                    @error('profile_picture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small text-uppercase">Address</label>
                                    <textarea name="address" rows="3" class="form-control bg-light @error('address') is-invalid @enderror" placeholder="Street, City, Country...">{{ old('address', $user->profile->address ?? '') }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <hr class="my-5 opacity-25">

                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-white shadow-sm px-4">Cancel</a>
                                <button type="submit" class="btn btn-primary shadow-sm px-5">
                                    <i class="bi bi-save me-2"></i>Update Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
