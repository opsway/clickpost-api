<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Api;

/**
 * Class Auth
 * @package OpsWay\Clickpost\Api
 */
class Auth
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Auth constructor.
     *
     * @param string $username
     * @param string $apiKey
     */
    public function __construct(string $username, string $apiKey)
    {
        $this->username = $username;
        $this->apiKey   = $apiKey;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
