@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Inventory
                    Management</h6>
                <h2 class="h3 fw-extrabold mb-0">Create New Product</h2>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-white shadow-sm border-0 px-3">
                    <i class="bi bi-arrow-left me-2"></i>Backtrack
                </a>
            </div>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-12 col-xl-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-4">General Information</h5>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-muted text-uppercase">Product
                                Name</label>
                            <input type="text"
                                class="form-control form-control-lg border-light-subtle @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="e.g. Wireless Noise Cancelling Headphones"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold small text-muted text-uppercase">Product
                                SKU</label>
                            <input type="text"
                                class="form-control form-control-lg border-light-subtle @error('sku') is-invalid @enderror"
                                id="sku" name="sku" placeholder="e.g. PR1" value="{{ old('sku') }}">
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label for="description"
                                class="form-label fw-bold small text-muted text-uppercase">Description</label>
                            <textarea class="form-control border-light-subtle @error('description') is-invalid @enderror" id="description"
                                name="description" rows="8" placeholder="Tell your customers about this product...">{{ old('description') }}</textarea>
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
                                        id="price" name="price" placeholder="0.00" value="{{ old('price') }}">
                                </div>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="image" class="form-label fw-bold small text-muted text-uppercase">Feature
                                    Image</label>
                                <input type="file"
                                    class="form-control form-control-lg border-light-subtle @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                <div class="form-text small">Recommended: 800x800px (PNG/JPG)</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <h5 class="fw-bold mb-4">Status & Visibility</h5>

                        <div
                            class="d-flex align-items-center justify-content-between p-3 border rounded-3 bg-light-subtle mb-4">
                            <div>
                                <h6 class="mb-0 fw-bold">Active Status</h6>
                                <small class="text-muted">Visible to customers</small>
                            </div>
                            <div class="form-check form-switch p-0 m-0">
                                <input class="form-check-input ms-0" type="checkbox" role="switch" id="is_active"
                                    name="is_active" value="1" style="width: 2.5rem; height: 1.25rem;" checked>
                            </div>
                        </div>

                        <div class="alert alert-info border-0 shadow-none small mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            When "Active", this product will appear in your public storefront immediately.
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm mb-3">
                            <i class="bi bi-cloud-arrow-up me-2"></i>Create Product
                        </button>
                        <button type="reset" class="btn btn-outline-secondary w-100 py-2 border-0 small">
                            Reset Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
