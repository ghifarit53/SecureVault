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
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'fullname' => 'required|unique:users|min:2|max:50',
            'country_code' => 'required',
            'province' => 'required',
            'city' => 'required',
            'password' => 'required|min:6|alpha_dash',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        //
        // Generate private and public key
        //
        $options = [
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            'digest_alg' => 'sha256',
        ];

        $key = openssl_pkey_new($options);
        if ($key == false) { // workaround when openssl failed to generate private key
            $options['config'] = '/opt/homebrew/etc/openssl@3/openssl.cnf';
        }
        $pkey = openssl_pkey_new($options);

        openssl_pkey_export($pkey, $validated['private_key'], null, $options);
        $validated['public_key'] = openssl_pkey_get_details($pkey)['key'];

        //
        // Generate certificate
        //
        $dn = [
            'countryName' => $validated['country_code'],
            'stateOrProvinceName' => $validated['province'],
            'localityName' => $validated['city'],
            'organizationName' => 'None',
            'organizationalUnitName' => 'None',
            'commonName' => $validated['fullname'],
            'emailAddress' => $validated['email'],
        ];

        $additionalInfo = [
            'Location' => $dn['localityName'] . ', ' . $dn['countryName'],
        ];

        $csr = openssl_csr_new($dn, $pkey, $options);
        $x509 = openssl_csr_sign($csr, null, $pkey, $days=365, $options);

        openssl_x509_export($x509, $validated['certificate']);

        User::create($validated);

        return redirect('/login')->with('signupSuccess', 'Successfully signed up, you can login to continue');
    }
}
