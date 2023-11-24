<?php

namespace App\Http\Controllers;
// require('./vendor/autoload.php');

use Illuminate\Http\Request;
use Encryption\Encryption;
use Encryption\Exception\EncryptionException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\File;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function index() {
        return view("upload", [
            "title" => "upload"
        ]);
    }

    public function store(Request $request) {
        // dd($request);
       // Validate the input
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4', // Specify the file validation rules
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the uploaded file
        $uploadedFile = $request->file('file');

        // Convert the file content to base64
        $fileBase64 = base64_encode(file_get_contents($uploadedFile));

        // Store the form data in the 'files' table
        $user = Auth::user(); // Get the currently authenticated user
        $encryptionKey = Str::random(32);

        $encryption = Encryption::getEncryptionObject();
        $iv = 'ABCDEFGHABCDEFGH';
        $encFile = $encryption->encrypt($fileBase64, $encryptionKey, $iv);

        $file = new File();
        $file->filename = $uploadedFile->getClientOriginalName();
        $file->file_extension = $uploadedFile->getClientOriginalExtension();
        $file->key = $encryptionKey;
        $file->user_id = $user->id;
        $file->file_base64 = $encFile;
        $file->save();

        return redirect()->intended('/vault');
    }
}
