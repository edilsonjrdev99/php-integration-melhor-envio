<?php

require './vendor/autoload.php';

use App\Configurations\MelhorEnvioConfig;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$clientId    = $_ENV['ME_CLIENT_ID'];
$secret      = $_ENV['ME_SECRET'];
$redirectUri = $_ENV['ME_REDIRECT_URI'];
$state       = $_ENV['ME_STATE'];
$email       = $_ENV['ME_EMAIL'];
$sandbox     = filter_var($_ENV['ME_SANDBOX'], FILTER_VALIDATE_BOOL);
$code        = $_ENV['ME_CODE'];

$melhorEnvioConfig = new MelhorEnvioConfig(
  $clientId,
  $secret,
  $redirectUri,
  $state,
  $email,
  $sandbox
);