<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiaryEntryController;
use App\Models\DiaryEntry;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Fetch all diary entries for the logged-in user
    $diaryEntries = DiaryEntry::all();

    // Return the view and pass the diary entries
    return view('dashboard', compact('diaryEntries'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes - Admin can only view diary entries
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard (View only)
    Route::get('/admin/dashboard', function () {
        // Fetch all diary entries for the admin to view
        $diaryEntries = \App\Models\DiaryEntry::all();
        return view('admin.dashboard', compact('diaryEntries')); // Pass entries to the view
    })->name('admin.dashboard');
    
    // Remove these routes for admin as they should only view
    // No ability for admin to create, update, or delete entries
    // Route::get('/diary/create', [DiaryEntryController::class, 'create'])->name('create');
    // Route::post('/diary', [DiaryEntryController::class, 'store'])->name('diary.store');
    // Route::get('/diary/{id}/edit', [DiaryEntryController::class, 'edit'])->name('diary.edit');
    // Route::put('/diary/{id}', [DiaryEntryController::class, 'update'])->name('diary.update');
    // Route::delete('/diary/{id}', [DiaryEntryController::class, 'destroy'])->name('diary.destroy');
});

Route::middleware('auth')->group(function () {
    // User-specific routes (create, edit, delete diary entries)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Show the form to create a new diary entry
    Route::get('/diary/create', [DiaryEntryController::class, 'create'])->name('create');
    
    // Store the new diary entry
    Route::post('/diary', [DiaryEntryController::class, 'store'])->name('diary.store');
    // Edit an existing diary entry
    Route::get('/diary/{id}/edit', [DiaryEntryController::class, 'edit'])->name('diary.edit');
    Route::put('/diary/{id}', [DiaryEntryController::class, 'update'])->name('diary.update');

    // Delete a diary entry
    Route::delete('/diary/{id}', [DiaryEntryController::class, 'destroy'])->name('diary.destroy');

    // View a specific diary entry
    Route::get('/diary/{id}', [DiaryEntryController::class, 'show'])->name('diary.show');
});

require __DIR__.'/auth.php';