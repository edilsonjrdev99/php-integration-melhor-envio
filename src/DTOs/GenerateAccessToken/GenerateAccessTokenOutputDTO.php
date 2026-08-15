<?php

namespace App\DTOs\GenerateAccessToken;

use App\Contracts\DTOInterface;
use App\Exceptions\HttpClientException;

class GenerateAccessTokenOutputDTO implements DTOInterface {
  public function __construct(
    public readonly ?string $tokenType    = null,
    public readonly ?string $accessToken  = null,
    public readonly ?string $refreshToken = null,
    public readonly ?int    $expiresIn    = null,
    public readonly bool    $error        = false,
    public readonly int     $statusCode   = 0,
    public readonly string  $message      = '',
  ) {}

  public static function fromError(HttpClientException $e): self {
    return new self(
      error:      true,
      statusCode: $e->getStatusCode(),
      message:    $e->getMessage(),
    );
  }

  public function toArray(): array {
    return [
      'error'        => $this->error,
      'tokenType'    => $this->tokenType,
      'accessToken'  => $this->accessToken,
      'refreshToken' => $this->refreshToken,
      'expiresIn'    => $this->expiresIn,
      'statusCode'   => $this->statusCode,
      'message'      => $this->message,
    ];
  }
}
