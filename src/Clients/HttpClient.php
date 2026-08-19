<?php

namespace App\Clients;

use App\Configurations\MelhorEnvioConfig;
use App\Contracts\HttpClientInterface;

class HttpClient implements HttpClientInterface {
  public function __construct(
    private HttpClientInterface $client,
    private MelhorEnvioConfig $config,
  ) {}

  public function get(string $url, array $options = []): mixed {
    $options['headers'] = $this->buildHeaders();
    return $this->client->get($url, $options);
  }

  public function post(string $url, array $options = []): mixed {
    $options['headers'] = $this->buildHeaders();
    return $this->client->post($url, $options);
  }

  public function put(string $url, array $options = []): mixed {
    $options['headers'] = $this->buildHeaders();
    return $this->client->put($url, $options);
  }

  public function delete(string $url, array $options = []): mixed {
    $options['headers'] = $this->buildHeaders();
    return $this->client->delete($url, $options);
  }

  private function buildHeaders(): array {
    return [
      'Accept'       => 'application/json',
      'Content-Type' => 'application/json',
      'User-Agent'   => "Aplicação ({$this->config->getEmail()})",
    ];
  }
}
