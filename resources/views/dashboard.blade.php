<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Entries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Diary App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <!-- Logout Form -->
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="border: none; padding: 0;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <header class="bg-primary py-3 text-white text-center">
        <div class="container">
            <h1>Diary Entries</h1>
        </div>
    </header>

    <main class="container py-5">
        <div class="card shadow">
            <div class="card-body">
                <!-- Add New Entry Button -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('create') }}" class="btn btn-primary">Add New Entry</a>
                </div>

                @if ($diaryEntries->isEmpty())
                    <p class="text-center">No diary entries found.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diaryEntries as $entry)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $entry->title }}</td>
                                    <td>{{ Str::limit($entry->content, 50) }}...</td>
                                    <td>
                                        @if ($entry->image)
                                            <img src="{{ asset('storage/' . $entry->image) }}" alt="Image" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            No image
                                        @endif
                                    </td>
                                    <td>{{ $entry->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('diary.show', $entry->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('diary.edit', $entry->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('diary.destroy', $entry->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Diary App. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
