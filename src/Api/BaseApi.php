<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Api;

use OpsWay\Clickpost\Client;

/**
 * Class BaseApi
 *
 * @package OpsWay\Clickpost\Api
 */
class BaseApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * BaseApi constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client, string $username, string $apiKey)
    {
        $this->client   = $client;
        $this->username = $username;
        $this->apiKey   = $apiKey;
    }
}
