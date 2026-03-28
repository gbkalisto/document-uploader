@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        {{-- Header Section --}}
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Analytics
                </h6>
                <h2 class="h3 fw-extrabold mb-0 text-dark">Dashboard Overview</h2>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.customers.export') }}" class="btn btn-primary shadow-sm px-4 hover-lift">
                        <i class="bi bi-download me-2"></i>Export Users
                    </a>
                </div>
            </div>
        </div>

        {{-- Stats Section --}}
        <div class="row g-4 mb-5">
            {{-- Total Users Card --}}
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-bounce">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-muted d-block mb-1 fw-medium small text-uppercase"
                                    style="letter-spacing: 0.5px;">Total Users</span>
                                <h3 class="fw-bold mb-0 text-dark">{{ $user_count ?? '100' }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documents Card --}}
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-bounce">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-muted d-block mb-1 fw-medium small text-uppercase"
                                    style="letter-spacing: 0.5px;">Documents</span>
                                <h3 class="fw-bold mb-0 text-dark">{{ $document_count ?? '450' }}</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="bi bi-file-earmark-text-fill fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Recent Customers Table --}}
            <div class="col-12 col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Recent Customers</h5>
                        <a href="{{ route('admin.customers.create') }}"
                            class="btn btn-light btn-sm rounded-pill px-3 border hover-lift">Add New</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 border-0 text-muted small text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">ID</th>
                                    <th class="border-0 text-muted small text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">Customer</th>
                                    <th class="border-0 text-muted small text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">Email</th>
                                    <th class="border-0 text-muted small text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">Phone</th>
                                    <th class="border-0 text-muted small text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">Aadhar</th>
                                    <th class="border-0 text-muted small text-uppercase fw-bold"
                                        style="font-size: 0.65rem;">Documents Count</th>
                                    <th class="border-0 text-muted small text-uppercase fw-bold text-end pe-4"
                                        style="font-size: 0.65rem;">Status</th>
                                </tr>
                            </thead>
                            <tbody class="border-top-0">
                                @foreach ($recentUsers as $user)
                                    <tr>
                                        <td class="ps-4 fw-medium text-muted">#{{ $user->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3 fw-bold text-primary"
                                                    style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <span class="fw-bold text-dark">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-muted small">{{ $user->email }}</td>
                                        <td class="text-muted small">{{ $user->profile->phone ?? 'N/A' }}</td>
                                        <td class="text-muted small">
                                            {{ $user->aadhar_last_four_digit ? 'XXXXXXXXXX ' . $user->aadhar_last_four_digit : 'N/A' }}
                                        </td>
                                        <td class="text-muted small">{{ $user->documents_count }}</td>
                                        <td class="text-end pe-4">
                                            <span
                                                class="badge rounded-pill px-3 py-2 {{ $user->is_active ? 'bg-success-soft text-success' : 'bg-danger-soft text-danger' }}"
                                                style="font-size: 0.7rem;">
                                                <i class="bi bi-circle-fill me-1" style="font-size: 0.4rem;"></i>
                                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 py-4 text-center">
                        <a href="{{ route('admin.customers.index') }}"
                            class="text-primary text-decoration-none fw-bold small">
                            View All Users <i class="bi bi-chevron-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Card & Button Bounce Effects */
        .hover-bounce {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }

        .hover-bounce:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        }

        /* Modern UI Essentials */
        .bg-success-soft {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-danger-soft {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .table-hover tbody tr:hover {
            background-color: #fbfcfe;
        }
    </style>
@endsection
