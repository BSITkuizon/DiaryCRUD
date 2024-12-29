<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Entry</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Diary Entry</h2>
                    </div>
                    <div class="card-body">
                        <!-- Diary Entry Content -->
                        <h1 class="card-title mb-4">Diary Title</h1>
                        
                        <p><strong>Content:</strong> This is the content of the diary entry.</p>
                        
                        <!-- Display the image if it exists -->
                        <div class="mb-4">
                            <!-- Display the image if it exists -->
                        @if ($entry->image)
                        <img src="{{ asset('storage/' . $entry->image) }}" alt="Image" style="width: 200px; height: auto;">
                    @else
                        <p>No image available.</p>
                    @endif
                        </div>
                        
                        <!-- Message for missing image -->
                        <!-- Uncomment if no image is available -->
                        <!-- <p>No image available.</p> -->

                        <p><strong>Created At:</strong> Dec 29, 2024</p>
                        
                        <a href="/dashboard" class="btn btn-primary mt-4">Back to Diary Entries</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
