<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Tests;

use OpsWay\Clickpost\Api;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    /**
     * @var Api
     */
    protected $api;

    public function setUp(): void
    {
        $this->api = new Api();
    }

    /**
     * @covers \OpsWay\Clickpost\Api::getUsername
     * @covers \OpsWay\Clickpost\Api::setUsername
     */
    public function testSetGetUsername()
    {
        $this->assertEquals($this->api, $this->api->setUsername('test'));
        $this->assertEquals('test', $this->api->getUsername());
    }
}
