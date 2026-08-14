<?php

require './vendor/autoload.php';

use App\Configurations\MelhorEnvioConfig;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$melhorEnvioConfig = new MelhorEnvioConfig(
  clientId:    $_ENV['ME_CLIENT_ID'],
  secret:      $_ENV['ME_SECRET'],
  redirectUri: $_ENV['ME_REDIRECT_URI'],
  state:       $_ENV['ME_STATE'],
  sandbox:     filter_var($_ENV['ME_SANDBOX'], FILTER_VALIDATE_BOOL)
);

echo 'PHP Integration - Melhor Envio!' . PHP_EOL;
echo $melhorEnvioConfig->getUrlOAuth2();