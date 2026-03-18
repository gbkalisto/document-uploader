@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Catalog
                </h6>
                <h2 class="h3 fw-extrabold mb-0">Product Management</h2>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button class="btn btn-white shadow-sm border-0 px-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-upload me-2"></i>Import
                    </button>
                    <button class="btn btn-white shadow-sm border-0 px-3">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm px-4">
                        <i class="bi bi-plus-lg me-2"></i>Add Product
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">All Products</h5>
                    <small class="text-muted">Manage your inventory and pricing</small>
                </div>
                <div class="input-group" style="width:30%">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search products...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-subtle">
                        <tr>
                            <th class="ps-4 border-0 text-muted small fw-bold text-uppercase">Product</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Description</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Price</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="pe-4 border-0 text-end text-muted small fw-bold text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 border overflow-hidden me-3"
                                            style="width: 50px; height: 50px;">
                                            @if ($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                                            @else
                                                <div
                                                    class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-0">{{ $product->name }}</div>
                                            <small class="text-muted text-uppercase" style="font-size: 0.65rem;">ID:
                                                #PROD-{{ $product->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted small text-truncate" style="max-width: 250px;">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-success-subtle text-{{ $product->is_active == 1 ? 'success' : 'danger' }} rounded-pill px-3 py-2 small">{{ $product->is_active == 1 ? 'Active' : 'inActive' }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-3 shadow-none border-0" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3">
                                            <li><a class="dropdown-item rounded-2"
                                                    href="{{ route('admin.products.edit', $product->id) }}"><i
                                                        class="bi bi-pencil me-2"></i>Edit Product</a></li>
                                            <li><a class="dropdown-item rounded-2 text-info" href="#"><i
                                                        class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}"
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
                                        <p class="mb-0">No products found in your inventory.</p>
                                        <a href="{{ route('admin.products.create') }}"
                                            class="btn btn-primary btn-sm mt-3">Add Your First Product</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($products->hasPages())
                <div class="card-footer bg-white border-0 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Import Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" class="mb-2">Upload CSV</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
