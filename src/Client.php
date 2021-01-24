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
    private const CLICKPOST_API_ENDPOINT = 'https://www.clickpost.in/api/';
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
    public function __construct()
    {
        $requestOptions = [
            'base_uri'    => self::CLICKPOST_API_ENDPOINT,
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

        return $this->processResult($this->httpClient->get($url, ['query' => $query]));
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

        return $this->processResult($this->httpClient->post($url, $body));
    }

    /**
     * @param ResponseInterface $response
     *
     * @return object
     *
     * @throws ApiErrorException
     */
    protected function processResult(ResponseInterface $response): object
    {
        try {
            $responseObject = \GuzzleHttp\json_decode((string) $response->getBody());
        } catch (\Exception $exception) {
            throw new ApiErrorException("Internal API server error: " . preg_replace( "/\r|\n|\r\n/", "", $response->getBody()), 503);
        }        

        if ($responseObject->meta->status !== self::CLICKPOST_STATUS_CODE_200 && $responseObject->meta->message != 'Success') {
            $statusCode    = (int)$responseObject->meta->status;
            $statusMessage = $responseObject->meta->message;
            throw new ApiErrorException('Error occurred during request. Status code: ' . $statusCode . ". Status message: " . $statusMessage, $statusCode);
        }

        return $responseObject;
    }
}
