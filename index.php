<?php

require './vendor/autoload.php';

use App\Clients\GuzzleAdapter;
use App\Clients\HttpClient;
use App\Configurations\MelhorEnvioConfig;
use App\Processes\GenerateAccessTokenProcess;
use App\Processes\GenerateOAuthUrlProcess;
use Dotenv\Dotenv;
use GuzzleHttp\Client as GuzzleClient;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$melhorEnvioConfig = new MelhorEnvioConfig(
  clientId:    $_ENV['ME_CLIENT_ID'],
  secret:      $_ENV['ME_SECRET'],
  redirectUri: $_ENV['ME_REDIRECT_URI'],
  state:       $_ENV['ME_STATE'],
  email:       $_ENV['ME_EMAIL'],
  sandbox:     filter_var($_ENV['ME_SANDBOX'], FILTER_VALIDATE_BOOL)
);

echo 'PHP Integration - Melhor Envio!' . PHP_EOL;

echo 'Url de redirect' . PHP_EOL;
$generateOAuthUrl = new GenerateOAuthUrlProcess($melhorEnvioConfig);
echo $generateOAuthUrl->run();

echo PHP_EOL . 'Gerando o Access Token' . PHP_EOL;
$guzzle  = new GuzzleClient();
$adapter = new GuzzleAdapter($guzzle);
$client  = new HttpClient($adapter);

$code     = $_ENV['ME_CODE'];
$generateAccessTokenProcess  = new GenerateAccessTokenProcess($client, $melhorEnvioConfig, $code);
$response = $generateAccessTokenProcess->run();

print_r($response);