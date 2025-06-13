<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => config('app.name', 'Laravel'),
            'site_description' => 'Your ecommerce platform',
            'admin_email' => config('mail.from.address'),
            'phone_number' => '',
            'address' => '',
            'logo' => '',
            'favicon' => '',
            'primary_color' => '#0d6efd',
            'footer_text' => 'Copyright © 2024. All rights reserved.',
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        // Store settings logic
        return redirect()->route('admin.settings.index')->with('success', 'Settings saved successfully');
    }

    public function show($id)
    {
        return view('admin.settings.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.settings.edit', compact('id'));
    }

    public function update(Request $request, $id = null)
    {
        // Update settings logic
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }

    public function destroy($id)
    {
        // Delete settings logic
        return redirect()->route('admin.settings.index')->with('success', 'Settings deleted successfully');
    }
} 