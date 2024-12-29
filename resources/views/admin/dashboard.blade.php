<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Diary Entries</h1>
                    
                    @if ($diaryEntries->isEmpty())
                        <p>No diary entries found.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created At</th>
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
                                                <img src="{{ asset('storage/' . $entry->image) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                No image
                                            @endif
                                        </td>
                                        
                                        <td>{{ $entry->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
