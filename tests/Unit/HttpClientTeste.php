<?php

namespace Tests\Unit;

use App\Clients\HttpClient;
use App\Configurations\MelhorEnvioConfig;
use App\Contracts\HttpClientInterface;
use PHPUnit\Framework\TestCase;

class HttpClientTeste extends TestCase {
  private HttpClientInterface $adapterMock;
  private MelhorEnvioConfig $melhorEnvioConfigMock;
  private HttpClient $httpClient;

  public function setUp(): void {
    $this->adapterMock           = $this->createMock(HttpClientInterface::class);
    $this->melhorEnvioConfigMock = $this->createStub(MelhorEnvioConfig::class);
    $this->httpClient            = new HttpClient($this->adapterMock, $this->melhorEnvioConfigMock);
  }

  public function test_deve_retornar_todos_os_headers_quando_post_for_chamado(): void {
    // Arrange
    $email = 'teste@email.com';

    $this->melhorEnvioConfigMock
      ->method('getEmail')
      ->willReturn($email);

    $expectedOptions = [
      'json'    => ['key' => 'value'],
      'headers' => [
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
        'User-Agent'   => "Aplicação ($email)",
      ],
    ];

    // assert
    $this->adapterMock
      ->expects($this->once())
      ->method('post')
      ->with('https://url.com', $expectedOptions);

    // act
    $this->httpClient->post('https://url.com', [
      'json' => ['key' => 'value']
    ]);
  }
}