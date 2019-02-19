<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\ClientInterface;
use OpsWay\Clickpost\Api\Auth;
use Psr\Http\Message\ResponseInterface;

class Client
{
    public const TEST_ENDPOINT = 'https://test.clickpost.in/api/';
    public const PROD_ENDPOINT = 'https://clickpost.in/api/';

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

    /**
     * @param string $url
     * @param array $data
     * @param Auth $authParams
     *
     * @return object
     *
     * @throws \Exception
     */
    public function post(string $url, array $data, Auth $authParams): object
    {
        $body = [
            'headers' => ['Content-Type' => 'application/json'],
            'body'    => \json_encode($data),
            'query'   => [
                'key'      => $authParams->getApiKey(),
                'username' => $authParams->getUsername()
            ]
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

    /**
     * @param ResponseInterface $response
     *
     * @return object
     *
     * @throws \Exception
     */
    protected function processResult(ResponseInterface $response): object
    {
        try {
            return \GuzzleHttp\json_decode($response->getBody());
        } catch (\Exception $exception) {

        }
        throw new \Exception('Response from Clickpost is not success');
    }
}
