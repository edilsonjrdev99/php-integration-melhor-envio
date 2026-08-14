<?php

namespace App\Interface;

interface HttpClientInterface {
  public function get(string $url, array $options = []): mixed;
  public function post(string $url, array $options = []): mixed;
}