<?php

declare(strict_types=1);

namespace OpsWay\Clickpost\Exception;

class ApiErrorException extends \Exception
{
    /**
     * @var string
     */
    protected $requestUrl;
    
    /**
     * @var string
     */
    protected $requestBody;

    /**
     * @param string $requestUrl
     *
     * @return $this
     */
    public function setRequestUrl(string $requestUrl): self
    {
        $this->requestUrl = $requestUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @param string $requestBody
     *
     * @return $this
     */
    public function setRequestBody(string $requestBody): self
    {
        $this->requestBody = $requestUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestBody(): string
    {
        return $this->requestBody;
    }
}
