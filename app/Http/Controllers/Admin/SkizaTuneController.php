<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkizaTune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SkizaTuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skizaTunes = SkizaTune::latest()->paginate(10);
        return view('admin.skiza-tunes.index', compact('skizaTunes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skiza-tunes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'download_instructions' => 'nullable|array',
            'mp3_file' => 'nullable|file|mimes:mp3,mpga|max:10240', // 10MB max
            'is_active' => 'boolean',
        ]);

        $skizaTune = new SkizaTune();
        $skizaTune->title = $validated['title'];
        $skizaTune->download_instructions = $request->download_instructions;
        $skizaTune->is_active = $request->has('is_active');

        // Handle MP3 file upload
        if ($request->hasFile('mp3_file') && $request->file('mp3_file')->isValid()) {
            $file = $request->file('mp3_file');
            $path = $file->store('skiza-tunes', 'public');
            $skizaTune->mp3_file_path = $path;
        }

        $skizaTune->save();

        return redirect()->route('admin.skiza-tunes.index')
            ->with('success', 'Skiza Tune created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skizaTune = SkizaTune::findOrFail($id);
        return view('admin.skiza-tunes.show', compact('skizaTune'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skizaTune = SkizaTune::findOrFail($id);
        return view('admin.skiza-tunes.edit', compact('skizaTune'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $skizaTune = SkizaTune::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'download_instructions' => 'nullable|array',
            'mp3_file' => 'nullable|file|mimes:mp3,mpga|max:10240', // 10MB max
            'is_active' => 'boolean',
        ]);

        $skizaTune->title = $validated['title'];
        $skizaTune->download_instructions = $request->download_instructions;
        $skizaTune->is_active = $request->has('is_active');

        // Handle MP3 file upload
        if ($request->hasFile('mp3_file') && $request->file('mp3_file')->isValid()) {
            // Delete the old file if it exists
            if ($skizaTune->mp3_file_path) {
                Storage::disk('public')->delete($skizaTune->mp3_file_path);
            }
            
            $file = $request->file('mp3_file');
            $path = $file->store('skiza-tunes', 'public');
            $skizaTune->mp3_file_path = $path;
        }

        $skizaTune->save();

        return redirect()->route('admin.skiza-tunes.index')
            ->with('success', 'Skiza Tune updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skizaTune = SkizaTune::findOrFail($id);
        
        // Delete the associated MP3 file if it exists
        if ($skizaTune->mp3_file_path) {
            Storage::disk('public')->delete($skizaTune->mp3_file_path);
        }
        
        $skizaTune->delete();

        return redirect()->route('admin.skiza-tunes.index')
            ->with('success', 'Skiza Tune deleted successfully.');
    }
}
