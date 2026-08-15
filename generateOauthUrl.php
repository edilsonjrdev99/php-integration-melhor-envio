<?php

require './index.php';

use App\Processes\GenerateOAuthUrlProcess;

echo 'Gerando uma url de login para o Oauth' . PHP_EOL;

$generateOAuthUrl = new GenerateOAuthUrlProcess($melhorEnvioConfig);
$urlOAuth         = $generateOAuthUrl->run();

echo $urlOAuth->url . PHP_EOL;