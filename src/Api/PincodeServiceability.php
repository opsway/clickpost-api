<?php

declare(strict_types=1);

namespace OpsWay\Clickpost\Api;

class PincodeServiceability extends BaseApi
{
    private const API_PATH = 'serviceability_api';

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
        $apiUrl = sprintf('%s/%s/', self::VERSION, self::API_PATH);
        $auth = new Auth($this->username, $this->apiKey);

        return $this->client->post($apiUrl, $data, $auth);
    }
}
