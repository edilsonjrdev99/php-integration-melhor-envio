<?php

require './index.php';

use App\Processes\GenerateOAuthUrlProcess;

echo 'Gerando uma url de login para o Oauth' . PHP_EOL;

$generateOAuthUrl = new GenerateOAuthUrlProcess($melhorEnvioConfig);

echo $generateOAuthUrl->run() . PHP_EOL;