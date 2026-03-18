@extends('layouts.app')

@section('content')
    <style>
        p.small.text-muted {
            margin-right: 10px;
        }
    </style>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Available Products</h2>
                        <p class="text-secondary mb-0">Browse our latest collection and shop now</p>
                    </div>
                    <button class="btn btn-outline-dark position-relative px-4">
                        <i class="bi bi-cart3 me-2"></i>Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </button>
                </div>

                @if (session('status'))
                    <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse ($products as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                        alt="Placeholder Image" style="height: 220px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold">
                                            ${{ number_format($product->price, 2) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body p-4 d-flex flex-column">
                                    <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>

                                    <p class="card-text text-muted small mb-4 flex-grow-1">
                                        {{ Str::limit($product->description, 90) }}
                                    </p>

                                    <form action="{{ route('products.purchase', $product->slug) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-primary w-100 py-2 fw-semibold rounded-3 shadow-sm">
                                            <i class="bi bi-bag-plus me-2"></i>Purchase Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="py-5 bg-white rounded-4 shadow-sm">
                                <i class="bi bi-search text-muted display-1 mb-3"></i>
                                <p class="text-muted fs-5">Our shelves are empty at the moment. Check back soon!</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Optional: Smooth hover effect for the cards */
        .transition-hover {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endsection
