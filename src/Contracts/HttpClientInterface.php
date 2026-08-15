<?php

namespace App\Contracts;

interface HttpClientInterface {
  public function get(string $url, array $options = []): mixed;
  public function post(string $url, array $options = []): mixed;
  public function put(string $url, array $options = []): mixed;
  public function delete(string $url, array $options = []): mixed;
}
