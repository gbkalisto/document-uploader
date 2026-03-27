@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Back link --}}
                <div class="mb-4 text-end">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary small fw-bold">
                        <i class="bi bi-arrow-left me-1"></i> BACK TO LIST
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-bounce">
                    <div class="card-header bg-white py-4 px-4 border-0">
                        <h4 class="fw-extrabold mb-1">Edit Document</h4>
                        <p class="text-muted mb-0 small">Update your document details or replace the file.</p>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('documents.update', $document->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Document Title</label>
                                <select name="title" id="title" required
                                    class="form-control bg-light border-0 py-3 @error('title') is-invalid @enderror">
                                    <option value="">Select Document</option>
                                    @php
                                        $options = [
                                            'Aadhar Card Front',
                                            'Aadhar Card Back',
                                            'Pan Card',
                                            'Ration Card',
                                            'Voter Id',
                                            'Driving License',
                                            'Registration Id',
                                            'Admit Card',
                                            'A Paper',
                                            'Q Paper',
                                        ];
                                    @endphp
                                    @foreach ($options as $option)
                                        <option value="{{ $option }}" @selected(old('title', $document->title) == $option)>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Update File (Leave
                                    blank to keep current)</label>
                                <div
                                    class="upload-area bg-light rounded-4 p-5 text-center border-2 border-dashed position-relative">
                                    <input type="file" name="document"
                                        class="position-absolute w-100 h-100 top-0 start-0 opacity-0 cursor-pointer"
                                        id="fileInput" accept="application/pdf"  onchange="updateFileName()">

                                    {{-- Placeholder for current file --}}
                                    <div id="uploadPlaceholder">
                                        <i class="bi bi-file-earmark-text fs-1 text-primary mb-2"></i>
                                        <h6 class="fw-bold">Current: {{ basename($document->file_path) }}</h6>
                                        <p class="text-muted small mb-0">Drag a new file here to replace it</p>
                                    </div>

                                    {{-- Preview for new selected file --}}
                                    <div id="fileSelected" class="d-none">
                                        <i class="bi bi-file-earmark-check fs-1 text-success mb-2"></i>
                                        <h6 id="fileNameDisplay" class="fw-bold mb-0"></h6>
                                        <button type="button" class="btn btn-sm btn-link text-danger mt-2"
                                            onclick="resetFile()">Cancel New Upload</button>
                                    </div>
                                </div>
                                @error('document')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bg-info bg-opacity-10 border-start border-4 border-info p-3 rounded-3 mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle-fill text-info me-3 fs-5"></i>
                                    <p class="small text-dark mb-0">
                                        <strong>Current File:</strong> <a
                                            href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                            class="text-decoration-none">View Existing Document</a>
                                    </p>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm hover-bounce">
                                    <i class="bi bi-save me-2"></i> Update Document
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-light py-3 fw-bold">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Keep your existing <style> and <script> blocks exactly as they are in the create form --}}
    <style>
        .fw-extrabold {
            font-weight: 800;
        }

        .border-dashed {
            border-style: dashed !important;
            border-color: #dee2e6 !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .hover-bounce {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
        }

        .hover-bounce:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.08) !important;
        }

        .upload-area:hover {
            background-color: #f1f4f9 !important;
            border-color: #0d6efd !important;
        }
    </style>

    <script>
        function updateFileName() {
            const input = document.getElementById('fileInput');
            const placeholder = document.getElementById('uploadPlaceholder');
            const displayArea = document.getElementById('fileSelected');
            const fileNameText = document.getElementById('fileNameDisplay');

            if (input.files.length > 0) {
                placeholder.classList.add('d-none');
                displayArea.classList.remove('d-none');
                fileNameText.innerText = input.files[0].name;
            }
        }

        function resetFile() {
            const input = document.getElementById('fileInput');
            const placeholder = document.getElementById('uploadPlaceholder');
            const displayArea = document.getElementById('fileSelected');

            input.value = '';
            placeholder.classList.remove('d-none');
            displayArea.classList.add('d-none');
        }
    </script>
@endsection
