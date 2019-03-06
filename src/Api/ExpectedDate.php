<?php

declare(strict_types = 1);

namespace OpsWay\Clickpost\Api;

class ExpectedDate extends BaseApi
{
    private const API_PATH = 'predicted_sla_api/';

    private const VERSION = 'v1';

    /**
     * @param array $data
     *
     * @return object
     *
     * @throws \Exception
     */
    public function get(array $data): object
    {
        return $this->client->post(self::VERSION . "/" . self::API_PATH, $data, new Auth($this->username, $this->apiKey));
    }
}
