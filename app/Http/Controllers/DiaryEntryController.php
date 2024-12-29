<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;

class DiaryEntryController extends Controller
{
    // Display a listing of the diary entries
   // In your controller
public function index()
{
    $diaryEntries = \App\Models\DiaryEntry::all(); // Fetch all diary entries
    return view('dashboard', compact('diaryEntries')); // Pass the variable to the view
}


    // Show the form for creating a new diary entry
    public function create()
    {
        return view('create');
    }

    // Store a newly created diary entry in storage
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image file
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    } else {
        $imagePath = null; // No image uploaded
    }

    DiaryEntry::create([
        'title' => $request->title,
        'content' => $request->content,
        'image' => $imagePath, // Save the image path in the database
    ]);

    return redirect()->route('dashboard')->with('success', 'Diary entry created successfully.');
}


    // Display the specified diary entry
   // Display the specified diary entry
public function show($id)
{
    $entry = DiaryEntry::findOrFail($id);
    return view('show', compact('entry')); // Pass the entry to the 'show' view
}

    // Show the form for editing the specified diary entry
    public function edit($id)
    {
        $entry = DiaryEntry::findOrFail($id);
        return view('edit', compact('entry'));
    }

    // Update the specified diary entry in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for the image file
        ]);
    
        $entry = DiaryEntry::findOrFail($id);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image from storage if it exists
            if ($entry->image) {
                Storage::disk('public')->delete($entry->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $entry->image; // Keep the old image if none is uploaded
        }
    
        $entry->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath, // Update the image path in the database
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Diary entry updated successfully.');
    }
    

    // Remove the specified diary entry from storage
    public function destroy($id)
    {
        $entry = DiaryEntry::findOrFail($id);
        $entry->delete();

        return redirect()->route('dashboard')->with('success', 'Diary entry deleted successfully.');
    }
}
