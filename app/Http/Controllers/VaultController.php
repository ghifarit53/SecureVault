<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaultController extends Controller
{
    public function index() {
        return view("vault", [
            "title" => "Vault"
        ]);
    }
}
