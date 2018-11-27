<?php

namespace Leet;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class HttpClient
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function post(string $url, array $data)
    {
        return $this->decode(
            $this->client->post($url, $data)
        );
    }

    protected function decode(Response $response)
    {
        return json_decode($response->getBody());
    }
}
