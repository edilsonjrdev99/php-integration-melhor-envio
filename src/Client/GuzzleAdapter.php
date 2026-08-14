<?php

namespace App\Client;

use App\Interface\HttpClientInterface;
use GuzzleHttp\ClientInterface;

class GuzzleAdapter implements HttpClientInterface {
  public function __construct(
    private ClientInterface $client
  ) {}

  public function get(string $url, array $options = []): mixed {
    return $this->client->request('GET', $url, $options);
  }

  public function post(string $url, array $options = []): mixed {
    return $this->client->request('POST', $url, $options);
  }
}
