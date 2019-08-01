<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Api;

class CancelOrder extends BaseApi
{
    private const API_PATH = 'cancel-order/';

    private const VERSION = 'v1';

    /**
     * @param string $waybill
     * @param int $cpId
     * @param string $cpAccountCode
     *
     * @return object
     *
     * @throws \Exception
     */
    public function cancel(string $waybill, int $cpId, string $cpAccountCode): object
    {
        return $this->client->get(self::VERSION . "/" . self::API_PATH, new Auth($this->username, $this->apiKey), ['waybill' => $waybill, 'cp_id' => $cpId, 'account_code' => $cpAccountCode]);
    }
}
