<?php

namespace App\Http\Controllers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Encryption\Encryption;
use Encryption\Exception\EncryptionException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;

class VaultController extends Controller
{
    public function index()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Retrieve the files associated with the user
            $files = File::where('user_id', $user->id)->get();

            // Now, $files contains all the files associated with the current user.
            return view(
                'vault',
                [
                    'title' => 'Vault',
                ],
                compact('files'),
            );
        }

        // Handle the case where the user is not authenticated (optional).
        return redirect()
            ->route('login')
            ->with('status', 'Please log in to access this page.');
    }

    public function downloadPage($id)
    {
        $value = $id;

        if (File::find($id)->user->id == Auth::user()->id) {
            $file = File::find($value);
            $decryptedFile = '';
            $iv = 'ABCDEFGHABCDEFGH';

            $encryption = Encryption::getEncryptionObject();
            $decryptedFile = $encryption->decrypt($file->file_base64, $file->key, $iv);

            // Decode the base64 content
            $fileContent = base64_decode($decryptedFile);

            // Set the appropriate headers for the file download
            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename=' . $file->filename,
            ];

            return Response::make($fileContent, 200, $headers);
        }

        return view(
            'download_page',
            [
                'title' => 'Download',
            ],
            compact('value'),
        );
    }

    public function download(Request $request, $id)
    {
        // dd(Encryption::listAvailableCiphers());
        $value = $id;
        $userInput = $request->input('input');
        // dd("$value $userInput");
        $file = File::find($value);
        if (!$file) {
            return back()->with('fileError', 'File Not Found!');
        }

        if ($file->user->id != Auth::user()->id) {
            $user = Auth::user();
            $privateKeyPem = $user->private_key;
            try {
                $decryptedKey = Crypt::decryptString($userInput, false, $privateKeyPem);

                $iv = 'ABCDEFGHABCDEFGH';
                $encryption = Encryption::getEncryptionObject();
                $decryptedFile = $encryption->decrypt($file->file_base64, $decryptedKey, $iv);
                // dd($decryptedKey);
                $fileContent = base64_decode($decryptedFile);

                // Set the appropriate headers for the file download
                $headers = [
                    'Content-Type' => 'application/octet-stream',
                    'Content-Disposition' => 'attachment; filename=' . $file->filename,
                ];

                // Create the response
                return Response::make($fileContent, 200, $headers);
            } catch (Exception $e) {
                return back()->with('keyError', 'Key is invalid!');
            }
        }

        // Create the response
        // $response = Response::make($fileContent, 200, $headers);

        // return Redirect::to('/vault')->with(['response' => $response]);
        // return $response;
    }
}
