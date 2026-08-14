<?php

namespace App\Configurations;

class MelhorEnvioConfig {

  public function __construct(
    private string $clientId,
    private string $secret,
    private string $redirectUri,
    private string $state,
    private bool   $sandbox = true
  ) {}  

  /**
   * Responsável por retornar a url de login do OAuth2
   */
  public function getUrlOAuth2(): string {
    $url = $this->sandbox
      ? 'https://sandbox.melhorenvio.com.br/oauth/authorize'
      : 'https://melhorenvio.com.br/oauth/authorize';

    return $url
      . "?client_id=$this->clientId"
      . "&redirect_uri=$this->redirectUri"
      . '&response_type=code'
      . "&state=$this->state"
      . '&scope=shipping-calculate';
  }
}