@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> {{-- Narrower column for forms feels more focused --}}

                <div class="d-flex justify-content-between align-items-end mb-4 shw">
                    <div>
                        <h2 class="fw-bold text-dark mb-1">Create New Post</h2>
                        <p class="text-secondary mb-0">Fill in the details below to publish a new entry</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary shadow-sm px-4">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="title"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Post Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control form-control-lg @error('title') is-invalid @enderror"
                                    placeholder="Enter a catchy title..." value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="subtitle"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Post Sub
                                    Title</label>
                                <input type="text" name="subtitle" id="subtitle"
                                    class="form-control form-control-lg @error('subtitle') is-invalid @enderror"
                                    placeholder="Enter a catchy subtitle..." value="{{ old('subtitle') }}" >
                                @error('subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Content</label>
                                <textarea name="body" id="content" rows="6" class="form-control @error('body') is-invalid @enderror"
                                    placeholder="What's on your mind?" required>{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text mt-2">Try to keep your content clear and engaging for your readers.
                                </div>
                            </div>


                            <div class="d-flex gap-3 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="publish"
                                        value="1" checked>
                                    <label class="form-check-label" for="publish">
                                        Publish Now
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_published" id="draft"
                                        value="0">
                                    <label class="form-check-label" for="draft">
                                        Save as Draft
                                    </label>
                                </div>
                            </div>

                            {{-- add published date --}}
                            <div class="mb-4">
                                <label for="published_at"
                                    class="form-label fw-semibold text-secondary small text-uppercase">Published
                                    Date</label>
                                <input type="date" name="published_at" id="published_at"
                                    class="form-control @error('published_at') is-invalid @enderror"
                                    value="{{ old('published_at') }}" required>
                                @error('published_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                <button type="reset" class="btn btn-light px-4 me-md-2"> <i class="bi bi-arrow-clockwise"></i> Reset</button>
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
