<?php

namespace App\DTOs\GenerateOAuthUrl;

use App\Contracts\DTOInterface;

class GenerateOAuthUrlOutputDTO implements DTOInterface {
  public function __construct(
    public readonly string $url,
  ) {}

  public function toArray(): array {
    return [
      'url' => $this->url,
    ];
  }
}
