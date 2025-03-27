<!-- Admin SkizaTune Edit View -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.skiza-tunes.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Skiza Tune</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('admin.skiza-tunes.update', $skizaTune->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-600">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $skizaTune->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="mp3_file" class="block text-sm font-medium text-gray-700 mb-1">MP3 File</label>
                @if($skizaTune->mp3_file_path)
                    <div class="mb-2 flex items-center">
                        <audio controls class="mr-2">
                            <source src="{{ asset('storage/' . $skizaTune->mp3_file_path) }}" type="audio/mp3">
                            Your browser does not support the audio element.
                        </audio>
                        <span class="text-sm text-gray-500">Current file: {{ basename($skizaTune->mp3_file_path) }}</span>
                    </div>
                @endif
                <input type="file" name="mp3_file" id="mp3_file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" accept="audio/mp3">
                <p class="mt-1 text-sm text-gray-500">Upload a new MP3 file to replace the current one (Max: 10MB)</p>
                @error('mp3_file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Download Instructions</label>
                <div class="border border-gray-300 rounded-md p-4">
                    <p class="mb-2 text-sm text-gray-600">Edit download instructions</p>
                    
                    <div id="instructions-container">
                        @if($skizaTune->download_instructions && count($skizaTune->download_instructions) > 0)
                            @foreach($skizaTune->download_instructions as $index => $instruction)
                                <div class="instruction-row flex items-center mb-2">
                                    <input type="text" name="download_instructions[{{ $index }}][step]" 
                                           value="{{ $instruction['step'] ?? 'Step ' . ($index + 1) }}" 
                                           class="w-1/3 px-3 py-2 border border-gray-300 rounded-md mr-2">
                                    <input type="text" name="download_instructions[{{ $index }}][description]" 
                                           value="{{ $instruction['description'] ?? '' }}" 
                                           class="w-2/3 px-3 py-2 border border-gray-300 rounded-md">
                                    @if($index > 0)
                                        <button type="button" class="remove-row ml-2 text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="instruction-row flex items-center mb-2">
                                <input type="text" name="download_instructions[0][step]" placeholder="Step 1" class="w-1/3 px-3 py-2 border border-gray-300 rounded-md mr-2">
                                <input type="text" name="download_instructions[0][description]" placeholder="Description" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                        @endif
                    </div>
                    
                    <button type="button" id="add-instruction" class="mt-2 inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add Step
                    </button>
                </div>
                @error('download_instructions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="is_active" class="inline-flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $skizaTune->is_active ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">Active</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Update Skiza Tune
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('instructions-container');
        const addButton = document.getElementById('add-instruction');
        let instructionCount = {{ $skizaTune->download_instructions ? count($skizaTune->download_instructions) : 1 }};

        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-row').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.instruction-row').remove();
            });
        });

        addButton.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'instruction-row flex items-center mb-2';
            
            newRow.innerHTML = `
                <input type="text" name="download_instructions[${instructionCount}][step]" placeholder="Step ${instructionCount + 1}" class="w-1/3 px-3 py-2 border border-gray-300 rounded-md mr-2">
                <input type="text" name="download_instructions[${instructionCount}][description]" placeholder="Description" class="w-2/3 px-3 py-2 border border-gray-300 rounded-md">
                <button type="button" class="remove-row ml-2 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            
            container.appendChild(newRow);
            instructionCount++;
            
            // Add event listener to the remove button
            const removeButton = newRow.querySelector('.remove-row');
            removeButton.addEventListener('click', function() {
                container.removeChild(newRow);
            });
        });
    });
</script>
@endpush
@endsection