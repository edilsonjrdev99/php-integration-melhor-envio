<?php

namespace App\Clients;

use App\Contracts\HttpClientInterface;

class HttpClient implements HttpClientInterface {
  public function __construct(
    private HttpClientInterface $client
  ) {}

  public function get(string $url, array $options = []): mixed {
    return $this->client->get($url, $options);
  }

  public function post(string $url, array $options = []): mixed {
    return $this->client->post($url, $options);
  }

  public function put(string $url, array $options = []): mixed {
    return $this->client->put($url, $options);
  }

  public function delete(string $url, array $options = []): mixed {
    return $this->client->delete($url, $options);
  }
}
