<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Crypto\Rsa\KeyPair;

class RegisterController extends Controller
{
    public function index() {
        return view("register", [
            "title" => "Register"
        ]);
    }

    public function store(Request $request) {
        // Generate public and private keys
        $config = [
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ];

        // Create keypair
        $pkey = openssl_pkey_new($config);

         // Get private key
        if ($pkey == false) { // means openssl failed to generate new pair of key
            $config['config'] = '/opt/homebrew/etc/openssl@3/openssl.cnf';
        }

        // should be alright now
        $pkey = openssl_pkey_new($config);
        openssl_pkey_export($pkey, $privateKey, NULL, $config);

        // Get public key
        $publicKey = openssl_pkey_get_details($pkey);
        $publicKey = $publicKey["key"];

        // Validate user data
        $validated = $request->validate([
            "username" => "required|unique:users|min:2|max:16|alpha_num",
            "fullname" => "required|unique:users|min:2|max:50",
            "nik" => "required|unique:users|max:16|alpha_num",
            "key" => "required|unique:users|max:16|alpha_num",
            "password" => "required|min:6|max:16|alpha_dash",
        ]);

        // Hash the password
        $validated["password"] = Hash::make($validated["password"]);

        // Assign public and private keys
        $validated["public_key"] = $publicKey;
        $validated["private_key"] = $privateKey;

        // dd($validated);
        // Create the user record
        $user = User::create($validated);


        return redirect('/login')->with('registerSuccess', "Registration success, please login to continue");
    }
}
