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
        // Generate public and private keys
        $new_key_pair = openssl_pkey_new([
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        openssl_pkey_export($new_key_pair, $private_key_pem);
        $details = openssl_pkey_get_details($new_key_pair);
        $public_key_pem = $details['key'];

        // Validate user data
        $validated = $request->validate([
            "username" => "required|unique:users|min:2|max:16|alpha_num",
            "fullname" => "required|min:2|max:50",
            "nik" => "required|max:16|alpha_num",
            "key" => "required|max:16|alpha_num",
            "password" => "required|min:6|max:16|alpha_dash",
        ]);

        // Hash the password
        $validated["password"] = Hash::make($validated["password"]);

        // Populate public and private keys
        $validated["public_key"] = $public_key_pem;
        $validated["private_key"] = $private_key_pem;

        // dd($validated);
        // Create the user record
        $user = User::create($validated);


        return redirect('/login')->with('registerSuccess', "Registration success, please login to continue");
    }
}
