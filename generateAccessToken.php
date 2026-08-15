<?php

require './index.php';

use App\Clients\GuzzleAdapter;
use App\Clients\HttpClient;
use App\Processes\GenerateAccessTokenProcess;
use GuzzleHttp\Client;

echo 'Gerando Access Token da Melhor Envio.' . PHP_EOL;

$guzzle        = new Client();
$guzzleAdapter = new GuzzleAdapter($guzzle);
$httpClient    = new HttpClient($guzzleAdapter);

$generateAccessTokenProcess = new GenerateAccessTokenProcess($httpClient, $melhorEnvioConfig, $code);

print_r($generateAccessTokenProcess->run());