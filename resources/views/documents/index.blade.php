@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Breadcrumb/Back link --}}
                <div class="mb-4 text-end">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary small fw-bold">
                        <i class="bi bi-arrow-left me-1"></i> BACK TO DASHBOARD
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-bounce">
                    <div class="card-header bg-white py-4 px-4 border-0">
                        <h4 class="fw-extrabold mb-1">Upload Document</h4>
                        <p class="text-muted mb-0 small">Please ensure your file is clear and readable.</p>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Documents</label>
                                {{-- <input type="text" name="title" class="form-control bg-light border-0 py-3 @error('title') is-invalid @enderror"
                                   placeholder="e.g. Aadhar Card, Driving License" value="{{ old('title') }}" required> --}}
                                <select name="title" id="title" required
                                    class="form-control bg-light border-0 py-3 @error('title') is-invalid @enderror">
                                    <option value="">Select Document</option>

                                    <option value="Aadhar Card Front"
                                        {{ old('title') == 'Aadhar Card Front' ? 'selected' : '' }}>
                                        Aadhar Card Front
                                    </option>

                                    <option value="Aadhar Card Back"
                                        {{ old('title') == 'Aadhar Card Back' ? 'selected' : '' }}>
                                        Aadhar Card Back
                                    </option>

                                    <option value="Pan Card" {{ old('title') == 'Pan Card' ? 'selected' : '' }}>
                                        Pan Card
                                    </option>

                                    <option value="Ration Card" {{ old('title') == 'Ration Card' ? 'selected' : '' }}>
                                        Ration Card
                                    </option>

                                    <option value="Voter Id" {{ old('title') == 'Voter Id' ? 'selected' : '' }}>
                                        Voter Id
                                    </option>

                                    <option value="Driving License"
                                        {{ old('title') == 'Driving License' ? 'selected' : '' }}>
                                        Driving License
                                    </option>

                                    <option value="Registration Id"
                                        {{ old('title') == 'Registration Id' ? 'selected' : '' }}>
                                        Registration Id
                                    </option>
                                    <option value="Admit Card" {{ old('title') == 'Admit Card' ? 'selected' : '' }}>
                                        Admit Card
                                    </option>
                                    <option value="Q Paper " {{ old('title') == 'Q Paper ' ? 'selected' : '' }}>
                                        Q Paper
                                    </option>
                                    <option value="A Paper" {{ old('title') == 'A Paper' ? 'selected' : '' }}>
                                        A Paper
                                    </option>

                                </select>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Select File</label>
                                <div
                                    class="upload-area bg-light rounded-4 p-5 text-center border-2 border-dashed position-relative">
                                    <input type="file" name="document"
                                        class="position-absolute w-100 h-100 top-0 start-0 opacity-0 cursor-pointer"
                                        id="fileInput" accept="application/pdf" onchange="updateFileName()" required>
                                    <div id="uploadPlaceholder">
                                        <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-2"></i>
                                        <h6 class="fw-bold">Click to upload or drag and drop</h6>
                                        <p class="text-muted small mb-0">PDF (Max. 5MB)</p>
                                    </div>
                                    <div id="fileSelected" class="d-none">
                                        <i class="bi bi-file-earmark-check fs-1 text-success mb-2"></i>
                                        <h6 id="fileNameDisplay" class="fw-bold mb-0"></h6>
                                        <button type="button" class="btn btn-sm btn-link text-danger mt-2"
                                            onclick="resetFile()">Change File</button>
                                    </div>
                                </div>
                                @error('document')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="bg-warning bg-opacity-10 border-start border-4 border-warning p-3 rounded-3 mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-exclamation-triangle-fill text-warning me-3 fs-5"></i>
                                    <p class="small text-dark mb-0">
                                        <strong>Upload Guidelines:</strong> Max file size is 5 MB. Please use clear file
                                        names and ensure your document is in PDF, JPG, or PNG format.
                                    </p>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm hover-bounce">
                                    <i class="bi bi-check-lg me-2"></i> Save Document
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
