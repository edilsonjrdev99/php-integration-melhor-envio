<?php

namespace App\Clients;

use App\Contracts\HttpClientInterface;
use App\Exceptions\HttpClientException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

class GuzzleAdapter implements HttpClientInterface {
  public function __construct(
    private ClientInterface $client
  ) {}

  public function get(string $url, array $options = []): mixed {
    return $this->request('GET', $url, $options);
  }

  public function post(string $url, array $options = []): mixed {
    return $this->request('POST', $url, $options);
  }

  public function put(string $url, array $options = []): mixed {
    return $this->request('PUT', $url, $options);
  }

  public function delete(string $url, array $options = []): mixed {
    return $this->request('DELETE', $url, $options);
  }

  private function request(string $method, string $url, array $options): mixed {
    try {
      return $this->client->request($method, $url, $options);
    } catch (RequestException $e) {
      $statusCode = $e->getResponse()?->getStatusCode() ?? 0;
      $body       = json_decode($e->getResponse()?->getBody()->getContents() ?? '[]', true) ?? [];

      throw new HttpClientException($statusCode, $body);
    }
  }
}
