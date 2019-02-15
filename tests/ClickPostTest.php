<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Tests;

use OpsWay\Clickpost\Api;
use PHPUnit\Framework\TestCase;

class ClickPostTest extends TestCase
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @var string
     */
    private $username = ''; // You can past you test username here

    /**
     * @var string
     */
    private $apiKey = ''; // You can past you test api key here
    
    public function setUp(): void
    {
        $this->api = (new Api(false))
            ->setUsername($this->username)
            ->setApiKey($this->apiKey);
    }

    /**
     * @throws \Exception
     */
    public function testAllocation()
    {
        $this->api->allocation()->recommendation([]);
    }
}
