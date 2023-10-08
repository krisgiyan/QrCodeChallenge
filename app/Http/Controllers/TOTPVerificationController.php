<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Facades\PragmaRX\Google2FA\Google2FA;


class TOTPVerificationController extends Controller
{
    public function showForm()
    {
        return view('google_authenticator_verification');
    }

    public function verify(Request $request)
    {
        $username = $request->input('username');
        $code = $request->input('code');

        $secret = Storage::get('secret.json');

        $secret_array = json_decode($secret, 1);

        if (array_key_exists($username, $secret_array)) 
        {

            $isValid = Google2FA::verifyKey($secret_array[$username], $code);

            if ($isValid) 
            {
                return response()->json(['message' => 'Code is valid'], 200);
            } 
            else 
            {
                return response()->json(['message' => 'Code is invalid'], 403);
            }
        }
        else
        {
            return response()->json(['message' => 'No such user'], 403);
        }
    }
}
