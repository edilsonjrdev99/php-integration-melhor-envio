<?php

require './index.php';

use App\Processes\GenerateAccessTokenProcess;

echo 'Gerando Access Token da Melhor Envio.' . PHP_EOL;

$generateAccessTokenProcess = new GenerateAccessTokenProcess($httpClient, $melhorEnvioConfig, $code);

print_r($generateAccessTokenProcess->run());