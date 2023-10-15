<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Encryption\Encryption;
use Encryption\Exception\EncryptionException;

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

    public function download(Request $request) {
        // dd($request);
        $value = $request->query('value');
        $userInput = $request->query('input');

        $hashkey = $userInput;
        $file = File::find($value);

        if(!$file) return back()->with('fileError', "File Not Found!");
        // dd("$hashkey ==== $file->hashed_key");
        if($hashkey != $file->hashed_key) return back()->with('fileError', "Wrong Key Password!");

        $decryptedFile = "";

        if($file->enc_type=='aes') {
            $encryption = Encryption::getEncryptionObject();
            $iv = $file->iv;
            $decryptedFile = $encryption->decrypt($file->file_base64, $userInput, $iv);
        } else if($file->enc_type=='rc4') {
            $encryption = Encryption::getEncryptionObject('rc4');
            $decryptedFile = $encryption->decrypt($file->file_base64, $userInput);
        } else {
            $encryption = Encryption::getEncryptionObject('des-cbc');
            $iv = $file->iv;
            $decryptedFile = $encryption->decrypt($file->file_base64, $userInput, $iv);
        }

        // Decode the base64 content
        $fileContent = base64_decode($decryptedFile);

        // Set the appropriate headers for the file download
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename=' . $file->filename,
        ];

        // Provide the file for download
        return Response::make($fileContent, 200, $headers);
    }
}
