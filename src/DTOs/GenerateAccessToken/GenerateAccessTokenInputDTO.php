<?php

namespace App\DTOs\GenerateAccessToken;

use App\Contracts\DTOInterface;

class GenerateAccessTokenInputDTO implements DTOInterface {
  public function __construct(
    public readonly string $code
  ) {}

  public function toArray(): array {
    return [
      'code' => $this->code
    ];
  }
}