<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaultController extends Controller
{
    public function index() {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Retrieve the files associated with the user
            $files = $user->files;

            // Now, $files contains all the files associated with the current user.
            return view("vault", [
                "title" => "Vault"
            ],compact('files'));
        }

        // Handle the case where the user is not authenticated (optional).
        return redirect()->route('login')->with('status', 'Please log in to access this page.');
    }
}
