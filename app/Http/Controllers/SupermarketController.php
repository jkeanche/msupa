<?php

namespace App\Http\Controllers;

use App\Models\Supermarket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupermarketController extends Controller
{
    // ...existing code...

    /**
     * Toggle the active status of the supermarket.
     */
    public function toggleStatus(Supermarket $supermarket)
    {
        // Only admins can deactivate supermarkets
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Unauthorized action.');
        }
        
        $supermarket->is_active = !$supermarket->is_active;
        $supermarket->save();
        
        $status = $supermarket->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Supermarket {$status} successfully!");
    }

    /**
     * Remove the specified supermarket from storage.
     */
    public function destroy(Supermarket $supermarket)
    {
        // Only admins can delete supermarkets
        if (!Auth::user()->isAdmin()) {
            return abort(403, 'Unauthorized action.');
        }
        
        // Delete associated files
        if ($supermarket->logo) {
            Storage::disk('public')->delete($supermarket->logo);
        }
        
        if ($supermarket->banner) {
            Storage::disk('public')->delete($supermarket->banner);
        }
        
        $supermarket->delete();
        
        return redirect()->route('admin.supermarkets.index')->with('success', 'Supermarket deleted successfully!');
    }
}