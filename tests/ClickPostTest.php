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
        $request = [[
            'pickup_pincode'   => 110017,
            'drop_pincode'     => 110019,
            'order_type'       => 'PREPAID',
            'reference_number' => '1',
            'item'             => 'bottle',
            'invoice_value'    => 1245,
            'delivery_type'    => 'FORWARD',
            'weight'           => 10,
            'height'           => 10,
            'length'           => 10,
            'breadth'          => 10,
        ]];

        $result = $this->api->allocation()->recommendation($request);

        self::assertEquals(200, $result->meta->status);
    }
}
