<!-- Admin SkizaTune Show View -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.skiza-tunes.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Skiza Tune Details</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $skizaTune->title }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.skiza-tunes.edit', $skizaTune->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.skiza-tunes.destroy', $skizaTune->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center text-sm" onclick="return confirm('Are you sure you want to delete this Skiza Tune?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Skiza Tune Information</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="mb-3">
                            <span class="block text-sm font-medium text-gray-500">ID</span>
                            <span class="block mt-1 text-sm text-gray-900">{{ $skizaTune->id }}</span>
                        </div>
                        <div class="mb-3">
                            <span class="block text-sm font-medium text-gray-500">Status</span>
                            <span class="block mt-1">
                                @if($skizaTune->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="block text-sm font-medium text-gray-500">Created At</span>
                            <span class="block mt-1 text-sm text-gray-900">{{ $skizaTune->created_at->format('F d, Y h:i A') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Last Updated</span>
                            <span class="block mt-1 text-sm text-gray-900">{{ $skizaTune->updated_at->format('F d, Y h:i A') }}</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Media</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($skizaTune->mp3_file_path)
                            <div class="mb-2">
                                <span class="block text-sm font-medium text-gray-500 mb-2">Audio File</span>
                                <audio controls class="w-full">
                                    <source src="{{ asset('storage/' . $skizaTune->mp3_file_path) }}" type="audio/mp3">
                                    Your browser does not support the audio element.
                                </audio>
                                <div class="mt-2 text-sm text-gray-500 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ basename($skizaTune->mp3_file_path) }}</span>
                                </div>
                            </div>
                        @else
                            <div class="mb-2 text-sm text-gray-500">
                                No audio file uploaded.
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="text-lg font-medium text-gray-900 mt-6 mb-2">Download Instructions</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if($skizaTune->download_instructions && count($skizaTune->download_instructions) > 0)
                            <ol class="list-decimal pl-5 space-y-3">
                                @foreach($skizaTune->download_instructions as $instruction)
                                    <li>
                                        <div class="font-medium">{{ $instruction['step'] ?? 'Step ' . ($loop->iteration) }}</div>
                                        <div class="text-sm text-gray-600">{{ $instruction['description'] ?? '' }}</div>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="text-sm text-gray-500">
                                No download instructions provided.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection