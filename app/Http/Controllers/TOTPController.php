<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use Facades\PragmaRX\Google2FA\Google2FA;


class TOTPController extends Controller
{
    public function generateTOTPView()
    {
        return view('generate-qr-form');
    }

    public function generateTOTP(Request $request)
    {
        $label = $request->input('label');
        $username = $request->input('username');

        $google2fa = app('pragmarx.google2fa');

        //generate secret
        $base32Secret = $google2fa->generateSecretKey(64);

        //save secret for user
        $this->writeSecret($base32Secret, $username);

        //generate url for qr
        $google2fa_url = Google2FA::getQRCodeUrl($label, $username, $base32Secret);

        //return qr code
        return response('<div>' . QrCode::generate($google2fa_url) . '</div>', 200);

    }

    private function writeSecret ($secret, $username) 
    {
        $secrets_file = Storage::get('secret.json');
        $secret_array = json_decode($secrets_file, 1);
        $secret_array[$username] = $secret;
        Storage::put('secret.json', json_encode($secret_array));
    }
}