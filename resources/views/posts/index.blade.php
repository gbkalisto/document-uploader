@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Posts</h2>
                        <p class="text-secondary mb-0">Overview of your recent posts and activity</p>
                    </div>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary shadow-sm px-4 py-2">
                        <i class="bi bi-plus-circle me-2"></i>Create New Post
                    </a>
                </div>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-secondary text-uppercase small fw-bold" style="width: 5%">
                                            #</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold" style="width: 25%">
                                            Title</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold" style="width: 40%">
                                            Content</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold" style="width: 10%">
                                            Is Published</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold" style="width: 15%">
                                            Created At</th>
                                        <th class="py-3 text-secondary text-uppercase small fw-bold text-end pe-4"
                                            style="width: 15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td class="ps-4 text-secondary">{{ $post->id }}</td>
                                            <td>
                                                <span class="fw-bold text-dark d-block">{{ $post->title }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted d-inline-block text-truncate"
                                                    style="max-width: 300px;">
                                                    {{ $post->body }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($post->is_published)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td class="text-secondary small">
                                                {{ $post->created_at->diffForHumans() }}
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group">
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="btn btn-sm btn-outline-primary px-3">Edit</a>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png"
                                                    alt="No data" class="mb-3" style="width: 60px; opacity: 0.5;">
                                                <p class="text-muted">No posts found in the database.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white py-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Showing {{ $posts->count() }} results</small>
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
