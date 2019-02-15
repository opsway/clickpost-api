<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    public const TEST_ENDPOINT = 'https://test.clickpost.in/api';
    public const PROD_ENDPOINT = 'https://clickpost.in/api';

    /**
     * @var BaseClient|ClientInterface|null
     */
    private $httpClient;

    /**
     * Client constructor.
     *
     * @param ClientInterface|null $httpClient
     */
    public function __construct(bool $production = true)
    {
        $requestOptions = [
            'base_uri'    => $production ?
                self::PROD_ENDPOINT :
                self::TEST_ENDPOINT,
            'http_errors' => false
        ];
        $this->httpClient = new BaseClient($requestOptions);
    }

    public function get(string $url)
    {
    }

    public function post(string $url, array $data)
    {
        echo $url;
        $body = [
            'headers' => ['content-type' => 'application/json'],
            'json'    => $data
        ];
        return $this->processResult(
            $this->httpClient->post($url, $body)
        );
    }

    public function put(string $url)
    {
    }

    public function delete(string $url)
    {
    }

    protected function processResult(ResponseInterface $response): array
    {
        $responseData = \json_decode($response->getBody()->getContents(), true);

        return $responseData;
    }
}
