<?php

namespace App\Configurations;

class MelhorEnvioConfig {

  public function __construct(
    private string $clientId,
    private string $secret,
    private string $redirectUri,
    private string $state,
    private string $email,
    private bool   $sandbox = true,
  ) {}  

  public function getBaseUrl(): string {
    return $this->sandbox
      ? 'https://sandbox.melhorenvio.com.br'
      : 'https://melhorenvio.com.br';
  }

  public function getClientId(): string {
    return $this->clientId;
  }

  public function getSecret(): string {
    return $this->secret;
  }

  public function getRedirectUri(): string {
    return $this->redirectUri;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function getState(): string {
    return $this->state;
  }

  public function isSandbox(): bool {
    return $this->sandbox;
  }
}
