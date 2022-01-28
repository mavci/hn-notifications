<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HN
{
    private $http;

    public function __construct()
    {
        $this->http = Http::baseUrl('https://hacker-news.firebaseio.com/v0/');
    }

    public function topStories()
    {
        return $this->http->get('topstories.json?print=pretty')->json();
    }

    public function getItem($id)
    {
        return $this->http->get('item/'.$id.'.json?print=pretty')->json();
    }
}
