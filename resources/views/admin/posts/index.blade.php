@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">Catalog
                </h6>
                <h2 class="h3 fw-extrabold mb-0">Post Management</h2>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button class="btn btn-white shadow-sm border-0 px-3">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm px-4">
                        <i class="bi bi-plus-lg me-2"></i>Add Post
                    </a>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 fw-bold">All Posts</h5>
                    <small class="text-muted">Manage your post and inventory</small>
                </div>
                <div class="input-group" style="width:30%">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search posts...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-subtle">
                        <tr>
                            <th class="ps-4 border-0 text-muted small fw-bold text-uppercase">Post Title</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Description</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Created By</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">publish Date</th>
                            <th class="border-0 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="pe-4 border-0 text-end text-muted small fw-bold text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="mb-0 text-muted small text-truncate">
                                            <span>{{ $post->title }}</span>
                                        </div>

                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted small text-truncate" style="max-width: 250px;">
                                        {{ Str::limit($post->body, 60) }}
                                    </p>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $post->user->name }}</span>
                                </td>
                                <td>
                                    <span>{{ $post->published_at }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-success-subtle text-{{ $post->is_published == 1 ? 'success' : 'danger' }} rounded-pill px-3 py-2 small">{{ $post->is_published == 1 ? 'Active' : 'inActive' }}</span>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-3 shadow-none border-0" type="button"
                                            data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-3">
                                            <li><a class="dropdown-item rounded-2"
                                                    href="{{ route('admin.posts.edit', $post->id) }}"><i
                                                        class="bi bi-pencil me-2"></i>Edit Product</a></li>
                                            <li><a class="dropdown-item rounded-2 text-info" href="#"><i
                                                        class="bi bi-eye me-2"></i>View Details</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this Post?')">
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

            @if ($posts->hasPages())
                <div class="card-footer bg-white border-0 py-4">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
