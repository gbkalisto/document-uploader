@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Catalog
                </h6>
                <h2 class="h3 fw-extrabold mb-0">Customer Management</h2>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.export.user.doc') }}" class="btn btn-white shadow-sm border-0 px-3">
                        <i class="bi bi-download me-2"></i>Export Documents
                    </a>
                    <a href="{{ route('admin.customers.export') }}" class="btn btn-white shadow-sm border-0 px-3">
                        <i class="bi bi-download me-2"></i>Export
                    </a>
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary shadow-sm px-4">
                        <i class="bi bi-plus-lg me-2"></i>Add Customer
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">All Customer</h5>
                    <small class="text-muted">Manage your all users </small>
                </div>
                <form method="GET" class="d-inline-block w-100" style="max-width: 300px;">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="search" name="query" class="form-control bg-light border-0 small"
                            placeholder="Search users..." aria-label="Search" value="{{ request('query') }}">
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-subtle">
                        <tr>
                            <th class="ps-4 border-0 text-muted small fw-bold text-uppercase">ID</th>
                            <th class="ps-4 border-0 text-muted small fw-bold text-uppercase">Name</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Email</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Phone</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Aadhar</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Document Count</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="pe-4 border-0 text-end text-muted small fw-bold text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-4">

                                    <span class="fw-bold text-dark">{{ $user->id }}</span>

                                </td>
                                <td class="ps-4">

                                    <span class="fw-bold text-dark">{{ $user->name }}</span>

                                </td>
                                <td>
                                    <p class="mb-0 text-muted small text-truncate">
                                        {{ $user->email }}
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted small text-truncate">
                                        {{ $user->profile->phone ?? 'N/A' }}
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted small text-truncate">
                                        {{ $user->aadhar_last_four_digit ?? 'N/A' }}
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted small text-truncate">
                                        <span class="badge bg-secondary">{{ $user->documents_count }}</span>
                                    </p>
                                </td>

                                <td>
                                    <span
                                        class="badge bg-{{ $user->is_active == 1 ? 'success' : 'danger' }}-subtle text-{{ $user->is_active == 1 ? 'success' : 'danger' }} rounded-pill px-3 py-2 small">{{ $user->is_active == 1 ? 'Active' : 'InActive' }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-3 shadow-none border-0" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3">
                                            <li><a class="dropdown-item rounded-2"
                                                    href="{{ route('admin.customers.edit', $user->id) }}"><i
                                                        class="bi bi-pencil me-2"></i>Edit Customer</a></li>
                                            <li><a class="dropdown-item rounded-2 text-info"
                                                    href="{{ route('admin.customers.documents', ['customer' => $user->id]) }}"><i
                                                        class="bi bi-eye me-2"></i>View Documents</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.customers.destroy', $user->id) }}"
                                                    method="POST" onsubmit="return confirm('Delete this product?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item rounded-2 text-danger"><i
                                                            class="bi bi-trash me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                                        <p class="mb-0">No Customer found in your list.</p>
                                        <a href="{{ route('admin.products.create') }}"
                                            class="btn btn-primary btn-sm mt-3">Add Your First Customer</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="card-footer bg-white border-0 py-4">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
