<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index');
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        // Store notification logic
        return redirect()->route('admin.notifications.index')->with('success', 'Notification created successfully');
    }

    public function show($id)
    {
        return view('admin.notifications.show', compact('id'));
    }

    public function edit($id)
    {
        return view('admin.notifications.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update notification logic
        return redirect()->route('admin.notifications.index')->with('success', 'Notification updated successfully');
    }

    public function destroy($id)
    {
        // Delete notification logic
        return redirect()->route('admin.notifications.index')->with('success', 'Notification deleted successfully');
    }
} 