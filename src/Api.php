<?php

declare(strict_types=1);

namespace OpsWay\Clickpost;

/**
 * Class Api
 *
 * @package OpsWay\Clickpost
 */
class Api
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
     * @var string
     */
    protected $endpointUrl;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if ($this->client === null) {
            $this->setClient(new Client($this->getEndpointUrl()));
        }
        return $this->client;
    }

    /**
     * @param Client $client
     *
     * @return Api
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $username
     *
     * @return Api
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $endpointUrl
     *
     * @return Api
     */
    public function setEndpointUrl(string $endpointUrl): self
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpointUrl(): string
    {
        return $this->endpointUrl;
    }

    /**
     * @return Api\Allocation
     *
     * @throws \Exception
     */
    public function allocation()
    {
        $this->validateApi();
        return new Api\Allocation($this->getClient(), $this->getUsername(), $this->getApiKey());
    }

    /**
     * @return Api\Tracking
     *
     * @throws \Exception
     */
    public function tracking()
    {
        $this->validateApi();
        return new Api\Tracking($this->getClient(), $this->getUsername(), $this->getApiKey());
    }

    /**
     * @return Api\Order
     *
     * @throws \Exception
     */
    public function order()
    {
        $this->validateApi();
        return new Api\Order($this->getClient(), $this->getUsername(), $this->getApiKey());
    }

    /**
     * @return Api\ExpectedDate
     *
     * @throws \Exception
     */
    public function expectedDate()
    {
        $this->validateApi();
        return new Api\ExpectedDate($this->getClient(), $this->getUsername(), $this->getApiKey());
    }

    /**
     * @return Api\CancelOrder
     *
     * @throws \Exception
     */
    public function cancel()
    {
        $this->validateApi();
        return new Api\CancelOrder($this->getClient(), $this->getUsername(), $this->getApiKey());
    }

    /**
     * @return Api\PincodeServiceability
     *
     * @throws \Exception
     */
    public function pincodeServiceability()
    {
        $this->validateApi();
        return new Api\PincodeServiceability($this->getClient(), $this->getUsername(), $this->getApiKey());
    }

    /**
     * @throws \Exception
     */
    private function validateApi()
    {
        if (empty($this->getApiKey()) || empty($this->getUsername())) {
            throw new \Exception('API not fully configured', 422);
        }
    }
}
