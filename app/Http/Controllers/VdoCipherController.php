<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VdoCipherController extends Controller
{
    private static $apiSecret = null;

    public function __construct()
    {
        static::$apiSecret = env('VDOCIPHER_API_SECRET');
    }

    private function getApiSecret() {
        return static::$apiSecret;
    }

    public function generateOTPInfo(String $id) {
        $url = "https://dev.vdocipher.com/api/videos/${id}/otp";
        $apiSecret = $this->getApiSecret();
        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Authorization" => "Apisecret ${apiSecret}",
            "Content-Type" => "application/json"
        ])->get($url, [
            'ttl' => 300
        ]);
        if ($response->ok()) {
            return $response->object();
        }
        return false;
    }
}
