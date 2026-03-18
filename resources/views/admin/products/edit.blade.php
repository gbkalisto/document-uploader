@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Inventory
                    Management</h6>
                <h2 class="h3 fw-extrabold mb-0">Edit Product: <span class="text-primary">{{ $product->name }}</span></h2>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-white shadow-sm border-0 px-3">
                    <i class="bi bi-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-12 col-xl-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-4">General Information</h5>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-muted text-uppercase">Product
                                Name</label>
                            <input type="text"
                                class="form-control form-control-lg border-light-subtle @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-muted text-uppercase">Product
                                SKU</label>
                            <input type="text"
                                class="form-control form-control-lg border-light-subtle @error('sku') is-invalid @enderror"
                                id="sku" name="sku" placeholder="e.g. PR1" value="{{ old('name', $product->sku) }}">
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label for="description"
                                class="form-label fw-bold small text-muted text-uppercase">Description</label>
                            <textarea class="form-control border-light-subtle @error('description') is-invalid @enderror" id="description"
                                name="description" rows="8">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold mb-4">Pricing & Media</h5>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-bold small text-muted text-uppercase">Sale Price
                                    ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-light-subtle border-end-0">$</span>
                                    <input type="number" step="0.01"
                                        class="form-control form-control-lg border-light-subtle border-start-0 @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="image" class="form-label fw-bold small text-muted text-uppercase">Replace
                                    Image</label>
                                <input type="file"
                                    class="form-control form-control-lg border-light-subtle @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                <div class="form-text small">Leave blank to keep current image.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-3">Current Image</h5>
                        <div class="rounded-3 border p-2 bg-light text-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-2 shadow-sm"
                                    style="max-height: 200px;" alt="Current Product">
                            @else
                                <div class="py-5 text-muted">
                                    <i class="bi bi-image fs-1 d-block"></i>
                                    No Image Uploaded
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-4">Status & Visibility</h5>

                        <div
                            class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-light-subtle mb-0">
                            <div>
                                <h6 class="mb-0 fw-bold">Active Status</h6>
                                <small class="text-muted small">Visible to customers</small>
                            </div>
                            <div class="form-check form-switch p-0 m-0">
                                <input class="form-check-input ms-0" type="checkbox" role="switch" id="is_active"
                                    name="is_active" value="1" style="width: 2.5rem; height: 1.25rem;"
                                    {{ $product->is_active ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm mb-3">
                            <i class="bi bi-check-circle me-2"></i>Update Product
                        </button>
                        <a href="{{ route('products.index') }}"
                            class="btn btn-outline-secondary w-100 py-2 border-0 small">
                            Discard Changes
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
