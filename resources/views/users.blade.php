<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Management</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        p.small.text-muted {
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-4">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">User Management</h4>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                + Add User
            </a>
        </div>

        <!-- Search & Filter -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Search user...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary w-100">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Table -->
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Post Count</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>

                                    <span class="badge bg-secondary">{{ $user->active_post_count }}</span>


                                    {{-- <a href="{{ route('posts.create') }}" class="btn btn-sm btn-info">Add New Post</a> --}}
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>
