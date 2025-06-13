<?php

namespace App\Http\Controllers;

use App\Models\SkizaTune;
use Illuminate\Http\Request;

class SkizaTuneController extends Controller
{
    /**
     * Display a listing of skiza tunes.
     */
    public function index()
    {
        $skizaTunes = SkizaTune::where('is_active', true)
                              ->latest()
                              ->get();
        
        return view('partials.skiza-tunes', compact('skizaTunes'));
    }

    /**
     * Display the specified skiza tune.
     */
    public function show($id)
    {
        $skizaTune = SkizaTune::where('is_active', true)->findOrFail($id);
        
        return view('skiza-tunes.show', compact('skizaTune'));
    }
}
