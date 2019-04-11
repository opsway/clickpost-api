<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost;

use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\ClientInterface;
use OpsWay\Clickpost\Api\Auth;
use OpsWay\Clickpost\Exception\ApiErrorException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    public const TEST_ENDPOINT = 'https://test.clickpost.in/api/';
    public const PROD_ENDPOINT = 'https://www.clickpost.in/api/';

    private const CLICKPOST_STATUS_CODE_200 = 200;

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

    /**
     * @param string $url
     * @param Auth $authParams
     * @param array $params
     *
     * @return object
     *
     * @throws \Exception
     */
    public function get(string $url, Auth $authParams, array $params = []): object
    {
        $query = array_merge([
            'key'      => $authParams->getApiKey(),
            'username' => $authParams->getUsername()
        ], $params);

        return $this->processResult($this->httpClient->get($url, ['query' => $query]), $url);
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

        return $this->processResult($this->httpClient->post($url, $body), $url, $body['body']);
    }

    /**
     * @param ResponseInterface $response
     * @param string $requestUrl
     * @param string $requestBody
     *
     * @return object
     *
     * @throws ApiErrorException
     */
    protected function processResult(ResponseInterface $response, string $requestUrl = '', string $requestBody = ''): object
    {
        $responseObject = \GuzzleHttp\json_decode($response->getBody());

        if ($responseObject->meta->status !== self::CLICKPOST_STATUS_CODE_200) {
            $statusCode    = (int)$responseObject->meta->status;
            $statusMessage = $responseObject->meta->message;
            throw (new ApiErrorException($statusMessage, $statusCode))
                ->setRequestUrl($requestUrl)
                ->setRequestBody($requestBody);
        }

        return $responseObject;
    }
}
