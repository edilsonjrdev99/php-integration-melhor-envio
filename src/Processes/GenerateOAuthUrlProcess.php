<?php

namespace App\Processes;

use App\Configurations\MelhorEnvioConfig;
use App\Contracts\ProcessInterface;
use App\DTOs\GenerateOAuthUrl\GenerateOAuthUrlOutputDTO;

class GenerateOAuthUrlProcess implements ProcessInterface {
  public function __construct(
    private MelhorEnvioConfig $melhorEnvioConfig
  ) {}

  public function run(): GenerateOAuthUrlOutputDTO {
    $url = $this->melhorEnvioConfig->isSandbox()
      ? 'https://sandbox.melhorenvio.com.br/oauth/authorize'
      : 'https://melhorenvio.com.br/oauth/authorize';

    $url .= "?client_id=" . $this->melhorEnvioConfig->getClientId()
      . "&redirect_uri=" . $this->melhorEnvioConfig->getRedirectUri()
      . "&response_type=code"
      . "&state=" . $this->melhorEnvioConfig->getState()
      . '&scope=shipping-calculate';

    return new GenerateOAuthUrlOutputDTO($url);
  }
}
