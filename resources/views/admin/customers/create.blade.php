@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Catalog</h6>
                <h2 class="h3 fw-extrabold mb-0">Create New Customer</h2>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-white shadow-sm px-3">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm rounded-4 overflow-hidden border-0">
                    <div class="card-header bg-white py-4 px-4 border-0">
                        <h5 class="mb-0 fw-bold">Customer Information</h5>
                        <small class="text-muted">Fill in the details below to register a new customer.</small>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control bg-light @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control bg-light @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="john@example.com" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Phone Number</label>
                                    <input type="text" name="phone" class="form-control bg-light @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+1 234 567 890">
                                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control bg-light @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                    @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-muted"></i></span>
                                        <input type="password" name="password" class="form-control bg-light @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                    </div>
                                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock text-muted"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control bg-light" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase">Profile Picture</label>
                                    <input type="file" name="profile_picture" class="form-control bg-light @error('profile_picture') is-invalid @enderror">
                                    <small class="text-muted mt-1 d-block">Formats: JPG, PNG (Max 2MB).</small>
                                    @error('profile_picture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small text-uppercase">Address</label>
                                    <textarea name="address" rows="3" class="form-control bg-light @error('address') is-invalid @enderror" placeholder="Enter complete address...">{{ old('address') }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <hr class="my-5 opacity-25">

                            <div class="d-flex justify-content-end gap-3">
                                <button type="reset" class="btn btn-white shadow-sm px-4">Reset Form</button>
                                <button type="submit" class="btn btn-primary shadow-sm px-5">
                                    <i class="bi bi-check-lg me-2"></i>Save Customer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
