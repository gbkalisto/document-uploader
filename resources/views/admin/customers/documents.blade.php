@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4 px-lg-5">
        {{-- Header --}}
        <div class="row align-items-center mb-5">
            <div class="col">
                <h6 class="text-uppercase text-muted fw-bold mb-1" style="letter-spacing: 1px; font-size: 0.7rem;">File
                    Manager</h6>
                <h2 class="h3 fw-extrabold mb-0 text-dark">Customer Documents</h2>
            </div>
        </div>

        {{-- User Group Section --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden hover-bounce">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3 fw-bold text-primary"
                        style="width: 45px; height: 45px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">{{ $user->name }}</h5>
                        <small class="text-muted">{{ $user->email }} • {{ $user->documents->count() }} Files</small>
                    </div>
                </div>
                <div>
                    <span
                        class="badge rounded-pill px-3 py-2 {{ $user->is_active ? 'bg-success-soft text-success' : 'bg-danger-soft text-danger' }}"
                        style="font-size: 0.7rem;">
                        {{ $user->is_active ? 'Active Account' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="card-body bg-light bg-opacity-50 p-4">
                <div class="row g-3">
                    {{-- Nested Loop for User Documents --}}
                    @forelse($user->documents as $doc)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="bg-white border rounded-3 p-3 d-flex align-items-center shadow-sm hover-lift">

                                {{-- Dynamic Icon Logic --}}
                                @php
                                    $isImage = in_array(strtolower($doc->file_type), [
                                        'jpg',
                                        'jpeg',
                                        'png',
                                        'gif',
                                        'webp',
                                    ]);
                                    $isPdf = strtolower($doc->file_type) === 'pdf';
                                @endphp

                                <div class="file-icon me-3 rounded-3 d-flex align-items-center justify-content-center
                {{ $isPdf ? 'bg-danger bg-opacity-10 text-danger' : ($isImage ? 'bg-primary bg-opacity-10 text-primary' : 'bg-secondary bg-opacity-10 text-secondary') }}"
                                    style="width: 45px; height: 45px;">

                                    @if ($isPdf)
                                        <i class="bi bi-file-earmark-pdf-fill fs-4"></i>
                                    @elseif($isImage)
                                        <i class="bi bi-image-fill fs-4"></i>
                                    @else
                                        <i class="bi bi-file-earmark-text-fill fs-4"></i>
                                    @endif
                                </div>

                                <div class="flex-grow-1 overflow-hidden">
                                    {{-- Using your explode logic for the filename --}}
                                    <h6 class="mb-0 text-dark fw-bold text-truncate">
                                        {{ explode('/', $doc->file_path)[2] ?? 'Document' }}
                                    </h6>
                                    <small class="text-muted">
                                        {{ $doc->created_at->format('M d, Y') }} • {{ strtoupper($doc->file_type) }}
                                    </small>
                                </div>

                                <div class="ms-2">
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu shadow-sm border-0">
                                            <li>
                                                {{-- Dynamic View Link: Open images/pdfs in new tab --}}
                                                <a class="dropdown-item small"
                                                    href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">
                                                    <i class="bi bi-eye me-2"></i>View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item small"
                                                    href="{{ asset('storage/' . $doc->file_path) }}" download>
                                                    <i class="bi bi-download me-2"></i>Download
                                                </a>
                                            </li>
                                            {{-- <li>
                                                <hr class="dropdown-divider">
                                            </li> --}}
                                            {{-- <li>
                                                <form action="#"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="dropdown-item small text-danger"><i
                                                            class="bi bi-trash me-2"></i>Delete</button>
                                                </form>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted small italic mb-0 px-2">No documents uploaded yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <style>
        .bg-success-soft {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-danger-soft {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .hover-bounce {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hover-bounce:hover {
            transform: translateY(-5px);
        }

        .hover-lift {
            transition: all 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
            border-color: #4361ee !important;
        }
    </style>
@endsection
