<?php

declare(strict_types = 1);

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
     * @var bool
     */
    protected $production = true;

    /**
     * Api constructor.
     *
     * @param bool $production
     */
    public function __construct(bool $production = true)
    {
        $this->production = $production;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if (\is_null($this->client)) {
            $this->setClient(new Client($this->production));
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
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
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
     * @throws \Exception
     */
    private function validateApi()
    {
        if (empty($this->getApiKey()) || empty($this->getUsername())) {
            throw new \Exception("API not fully configured", 422);
        }
    }
}
