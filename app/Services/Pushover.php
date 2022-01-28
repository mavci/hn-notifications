<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Pushover
{
    private $token;
    private $http;

    public function __construct()
    {
        $this->token = config('pushover.token');
        $this->http = Http::baseUrl('https://api.pushover.net/1/');
    }

    public function send($userKey, $message, $url = null, $sound = 'none')
    {
        return $this->http->post('messages.json', [
            'token' => $this->token,
            'user' => $userKey,
            'message' => $message,
            'url' => $url,
            'sound' => $sound
        ]);
    }

    public function validate($userKey)
    {
        $response = $this->http->post('users/validate.json', [
            'token' => $this->token,
            'user' => $userKey
        ]);

        return $response->json()['status'] == 1;
    }
}
