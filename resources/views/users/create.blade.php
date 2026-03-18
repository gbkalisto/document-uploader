@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> {{-- Narrower column for forms feels more focused --}}

                <div class="d-flex justify-content-between align-items-end mb-4 shw">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Create New User</h2>
                        {{-- <p class="text-secondary mb-0">Fill in the details below to publish a new entry</p> --}}
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary shadow-sm px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="name"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Enter Name" value="{{ old('name') }}" >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="subtitle"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Enter Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="Enter password" value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control form-control-lg"
                                    placeholder="Repeat password" value="{{ old('password_confirmation') }}">

                            </div>


                            <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                <button type="reset" class="btn btn-light px-4 me-md-2">Reset</button>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                    <i class="bi bi-check-lg me-2"></i>Publish Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-light rounded-3 border-start border-primary border-4">
                    <p class="small text-muted mb-0">
                        <strong>Tip:</strong> You can use Markdown or HTML if your application supports it. All posts are
                        reviewed before going live.
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
