<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() {
        return view("register", [
            "title" => "Register"
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "username" => "required|unique:users|min:2|max:16|alpha_num",
            "fullname" => "required|min:2|max:50",
            "nik" => "required|max:16|alpha_num",
            "password" => "required|min:6|max:16|alpha_dash",
        ]);

        $validated["password"] = Hash::make($validated["password"]);
        
        User::create($validated);

        return redirect('/login')->with('registerSuccess', "Registration success, please login to continue");
    }
}
