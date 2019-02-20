<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Api;

class Tracking extends BaseApi
{
    private const API_PATH = 'track-order/';

    private const VERSION = 'v2';

    /**
     * @param string $waybill
     * @param int $cpId
     *
     * @return object
     *
     * @throws \Exception
     */
    public function tracking(string $waybill, int $cpId)
    {
        return $this->client->get(self::VERSION . "/" . self::API_PATH, new Auth($this->username, $this->apiKey), ['waybill' => $waybill, 'cp_id' => $cpId]);
    }
}
