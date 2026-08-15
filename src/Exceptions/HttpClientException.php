<?php

namespace App\Exceptions;

use RuntimeException;

class HttpClientException extends RuntimeException {
  public function __construct(
    private int    $statusCode,
    private array  $body,
    string         $message = ''
  ) {
    parent::__construct($message ?: "HTTP error $statusCode");
  }

  public function getStatusCode(): int {
    return $this->statusCode;
  }

  public function getBody(): array {
    return $this->body;
  }
}
