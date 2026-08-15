<?php

namespace App\Clients;

use App\Contracts\HttpClientInterface;
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

  public function put(string $url, array $options = []): mixed {
    return $this->client->request('PUT', $url, $options);
  }

  public function delete(string $url, array $options = []): mixed {
    return $this->client->request('DELETE', $url, $options);
  }
}
