<?php

namespace Tests\Unit;

use App\Clients\HttpClient;
use App\Configurations\MelhorEnvioConfig;
use App\Contracts\HttpClientInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase {
  private HttpClientInterface $adapterMock;
  private MelhorEnvioConfig $melhorEnvioConfigMock;
  private HttpClient $httpClient;

  public function setUp(): void {
    $this->adapterMock           = $this->createMock(HttpClientInterface::class);
    $this->melhorEnvioConfigMock = $this->createStub(MelhorEnvioConfig::class);
    $this->httpClient            = new HttpClient($this->adapterMock, $this->melhorEnvioConfigMock);
  }

  #[DataProvider('httpMethodsProvider')]
  public function test_deve_adicionar_headers_em_todos_os_metodos(string $method, array $options): void {
    // arrange
    $email = 'teste@email.com';

    $this->melhorEnvioConfigMock
      ->method('getEmail')
      ->willReturn($email);

    $expectedOptions = array_merge($options, [
      'headers' => [
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
        'User-Agent'   => "Aplicação ($email)",
      ],
    ]);

    // assert
    $this->adapterMock
      ->expects($this->once())
      ->method($method)
      ->with('https://url.com', $expectedOptions);

    // act
    $this->httpClient->$method('https://url.com', $options);
  }

  public static function httpMethodsProvider(): array {
    return [
      'get'    => ['get',    []],
      'post'   => ['post',   ['json' => ['key' => 'value']]],
      'put'    => ['put',    ['json' => ['key' => 'value']]],
      'delete' => ['delete', []],
    ];
  }
}
