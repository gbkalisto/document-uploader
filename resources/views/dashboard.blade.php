@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-11">

                {{-- Welcome Header --}}
                <div class="row align-items-center mb-5">
                    <div class="col-md-8">
                        <h2 class="fw-extrabold text-dark mb-1">Welcome back, {{ Auth::user()->name }}!</h2>
                        <p class="text-secondary mb-0">Manage your documents and account settings.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('documents.create') }}" class="btn btn-primary shadow px-4 py-2 hover-bounce">
                            <i class="bi bi-cloud-arrow-up me-2"></i>Upload New Document
                        </a>
                    </div>
                </div>

                <div class="row">
                    {{-- Left Side: Document Management --}}
                    <div class="col-lg-12">

                        {{-- Single Stat Card with Bounce --}}
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm rounded-4 hover-bounce">
                                    <div class="card-body p-4 d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 me-4">
                                            <i class="bi bi-files fs-2"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-muted small text-uppercase fw-bold mb-1">Total Documents</h6>
                                            <h2 class="fw-extrabold mb-0">{{ $doc_count }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <a href="{{ route('documents.create') }}" style="text-decoration:none">
                                    <div class="card border-0 shadow-sm rounded-4 hover-bounce">
                                        <div class="card-body p-4 d-flex align-items-center">
                                            <div class="bg-danger bg-opacity-10 text-primary p-3 rounded-4 me-4">
                                                <i class="bi bi-plus fs-2"></i>
                                            </div>
                                            <div>
                                                <h6 class="text-muted small text-uppercase fw-bold mb-1">Add Documents</h6>
                                                {{-- <h2 class="fw-extrabold mb-0">{{ $doc_count }}</h2> --}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>


                        {{-- Recent Documents Table --}}
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                            <div
                                class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold text-dark">My Uploaded Documents</h5>
                                <a href="{{ route('documents.create') }}"
                                    class="btn btn-light btn-sm rounded-pill px-3 border hover-lift">Add New</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 border-0 text-muted small text-uppercase">File Details</th>
                                            <th class="ps-4 border-0 text-muted small text-uppercase">Title</th>
                                            <th class="border-0 text-muted small text-uppercase text-center">Status</th>
                                            <th class="border-0 text-muted small text-uppercase text-end pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($documents as $document)
                                            <tr>
                                                <td class="ps-4 py-3">
                                                    <div class="d-flex align-items-center">
                                                        {{-- Dynamic Icon based on File Type --}}
                                                        <div
                                                            class="file-icon-box {{ $document->file_type == 'pdf' ? 'bg-danger text-danger' : 'bg-primary text-primary' }} bg-opacity-10 me-3">
                                                            <i
                                                                class="bi {{ $document->file_type == 'pdf' ? 'bi-file-earmark-pdf' : 'bi-file-earmark-image' }}"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold text-dark">
                                                                {{ explode('/', $document->file_path)[2] }}</div>
                                                            <small class="text-muted">
                                                                Uploaded on {{ $document->created_at->format('M d, Y') }} •
                                                                {{ $document->file_size }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span>{{ $document->title }}</span>
                                                </td>
                                                <td class="text-center">
                                                    @if ($document->status == 'verified')
                                                        <span
                                                            class="badge rounded-pill bg-success-soft text-success px-3 py-2">
                                                            <i class="bi bi-check-circle me-1"></i> Verified
                                                        </span>
                                                    @elseif($document->status == 'pending')
                                                        <span
                                                            class="badge rounded-pill bg-warning-soft text-warning px-3 py-2">
                                                            <i class="bi bi-clock-history me-1"></i> Pending
                                                        </span>
                                                    @else
                                                        <span
                                                            class="badge rounded-pill bg-danger-soft text-danger px-3 py-2">
                                                            <i class="bi bi-x-circle me-1"></i> Rejected
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm shadow-sm" type="button"
                                                            id="dropdownMenuButton{{ $document->id }}"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>

                                                        <ul class="dropdown-menu dropdown-menu-end shadow border-0"
                                                            aria-labelledby="dropdownMenuButton{{ $document->id }}">
                                                            <li>
                                                                <a class="dropdown-item py-2"
                                                                    href="{{ asset('storage/' . $document->file_path) }}"
                                                                    target="_blank">
                                                                    <i class="bi bi-eye me-2 text-primary"></i> View
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a class="dropdown-item py-2"
                                                                    href="{{ asset('storage/' . $document->file_path) }}"
                                                                    download>
                                                                    <i class="bi bi-download me-2 text-success"></i>
                                                                    Download
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('documents.edit',['document'=>$document->id]) }}" type="submit"
                                                                    class="dropdown-item py-2 text-success">
                                                                    <i class="bi bi-pencil me-2"></i> Edit
                                                                </a>

                                                            </li>

                                                            <li>
                                                                <form
                                                                    action="{{ route('documents.destroy', $document->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this document?')"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="dropdown-item py-2 text-danger">
                                                                        <i class="bi bi-trash me-2"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5">
                                                    <div class="py-4">
                                                        <div class="bg-light d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                                                            style="width: 80px; height: 80px;">
                                                            <i class="bi bi-file-earmark-plus fs-1 text-muted"></i>
                                                        </div>
                                                        <h5 class="fw-bold text-dark">No Documents Found</h5>
                                                        <p class="text-secondary small mb-4">You haven't uploaded any
                                                            verification documents yet.</p>
                                                        <a href="{{ route('documents.create') }}"
                                                            class="btn btn-primary btn-sm px-4 py-2 hover-bounce">
                                                            Upload Your First Document
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- table-responsive ends above --}}

                            @if ($documents->hasPages())
                                <div class="card-footer bg-white border-0 py-3 px-4">
                                    <div class="justify-content-between align-items-center flex-wrap">
                                        <div class="mt-2 mt-md-0">
                                            {{ $documents->links('pagination::bootstrap-5') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right Side: Profile Summary --}}
                    {{-- <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 mb-4 hover-bounce">
                            <div class="card-body p-4 text-center">
                                <div class="position-relative d-inline-block mb-3">
                                    @if (Auth::user()->profile && Auth::user()->profile->profile_picture)
                                        <img src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}"
                                            class="rounded-circle shadow-sm border border-4 border-white"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-muted mx-auto shadow-sm"
                                            style="width: 100px; height: 100px;">
                                            <i class="bi bi-person fs-1"></i>
                                        </div>
                                    @endif
                                </div>
                                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                                <p class="text-muted small mb-4">{{ Auth::user()->email }}</p>

                                <div class="d-grid gap-2">
                                    <a href="{{ route('users.profile') }}"
                                        class="btn btn-primary fw-bold py-2 shadow-sm">
                                        <i class="bi bi-pencil-square me-2"></i>Update Profile
                                    </a>
                                    <a href="javascript:void(0)"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-dash-form').submit();"
                                        class="btn btn-light fw-bold py-2 text-danger"><i
                                            class="bi bi-box-arrow-right me-2"></i>Sign Out</a>
                                    <form id="logout-dash-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>



                                </div>
                            </div>
                        </div>

                        <div class="card border-0 bg-dark shadow-sm rounded-4 text-white">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-shield-lock fs-4 me-3 text-warning"></i>
                                    <h6 class="fw-bold mb-0">Security Tip</h6>
                                </div>
                                <p class="small mb-0 opacity-75">Always ensure your uploaded documents are in PDF or JPG
                                    format and don't exceed 5MB per file.</p>
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>

    <style>
        /* Admin-style Bouncing Effect */
        .hover-bounce {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        }

        .hover-bounce:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
        }

        /* Modern Aesthetics */
        .fw-extrabold {
            font-weight: 800;
        }

        .bg-success-soft {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .btn-white {
            background: white;
            color: #6c757d;
            border: 1px solid #edf2f9;
        }

        .btn-white:hover {
            background: #f8f9fa;
            color: #333;
        }

        .file-icon-box {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.25rem;
        }

        .table thead th {
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        /* Status Badge Soft Colors */
        .bg-success-soft {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-warning-soft {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-danger-soft {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .btn-white {
            background: white;
            color: #6c757d;
            border: 1px solid #edf2f9;
        }
    </style>
@endsection
