<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diary Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
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
    

    <!-- Page Header -->
    <header class="bg-primary text-white py-4">
        <div class="container">
            <h1 class="text-center">Edit Diary Entry</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="mb-4">Edit Diary Entry</h2>

                <form action="{{ route('diary.update', $entry->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title Input -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="form-control" 
                            value="{{ old('title', $entry->title) }}" 
                            required>
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Content Textarea -->
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="5" 
                            class="form-control" 
                            required>{{ old('content', $entry->content) }}</textarea>
                        @error('content')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload New Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image Display -->
                    @if ($entry->image)
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            <div>
                                <img src="{{ asset('storage/' . $entry->image) }}" alt="Current Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Update Entry</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 text-center">
        <p class="mb-0">&copy; 2024 Diary App. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
