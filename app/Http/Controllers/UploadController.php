<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\File;

class UploadController extends Controller
{
    public function index() {
        return view("upload", [
            "title" => "upload"
        ]);
    }

    public function store(Request $request) {
       // Validate the input
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4', // Specify the file validation rules
            'key' => 'required|string',        
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
        $encryptionType = $request->input('flexRadioDefault');
        $encryptionKey = Hash::make($request->input('key'));

        // $encryption = Encryption::getEncryptionObject();
        // $iv = $encryption->generateIv();

        $file = new File();
        $file->filename = $uploadedFile->getClientOriginalName();
        $file->file_extension = $uploadedFile->getClientOriginalExtension();
        $file->user_id = $user->id;
        $file->iv_encryption = "testttt";
        $file->hashed_key = $encryptionKey;
        $file->enc_type =  $encryptionType;
        $file->file_base64 = $fileBase64;
        $file->save();

        return redirect()->intended('/vault');
    }
}
