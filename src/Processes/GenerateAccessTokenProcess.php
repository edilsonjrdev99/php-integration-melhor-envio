<?php

namespace App\Processes;

use App\Clients\HttpClient;
use App\Configurations\MelhorEnvioConfig;
use App\Contracts\ProcessInterface;
use App\Exceptions\HttpClientException;

class GenerateAccessTokenProcess implements ProcessInterface {
  public function __construct(
    private HttpClient $client,
    private MelhorEnvioConfig $config,
    private string $code
  ) {}

  public function run(): array {
    $url     = $this->config->getBaseUrl() . '/oauth/token';
    $email   = $this->config->getEmail();
    $headers = [
      'Accept'       => 'application/json',
      'Content-Type' => 'application/json',
      'User-Agent'   => "Aplicação ($email)",
    ];

    $body = [
      'grant_type'    => 'authorization_code',
      'client_id'     => $this->config->getClientId(),
      'client_secret' => $this->config->getSecret(),
      'redirect_uri'  => $this->config->getRedirectUri(),
      'code'          => $this->code,
    ];

    $options = [
      'headers' => $headers,
      'json'    => $body,
    ];

    try {
      $response = $this->client->post($url, $options);
      return json_decode($response->getBody()->getContents(), true);
    } catch(HttpClientException $e) {
      return [
        'erro'   => true,
        'status' => $e->getStatusCode(),
        'body'   => $e->getBody()
      ];
    }
  }
}
