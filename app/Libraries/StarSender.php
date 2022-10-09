<?php

namespace App\Libraries;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class StarSender
{
    public static function sendWA($phone, $message = "")
    {
        $apikey     = "96b3f6285efa2a018d223f14c1e8b7b0a80b1a34";
        $tujuan     = rawurlencode($phone.'@s.whatsapp.net');
        $pesan      = rawurlencode($message);
        $filePath   = "https://starsender.online/api/";

        try {
            $sent = Http::withHeaders([
                'apikey' => $apikey,
            ])->post($filePath . 'sendFiles?message=' . $pesan . '&tujuan=' . $tujuan);

            return $sent->json();
        } catch (ConnectException $e) {
            return $e;
        }

        return null;
    }
}
