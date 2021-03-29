<?php

namespace Scn\EvalancheSoapApiConnector;

/**
 * Class EvalancheConfig
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class EvalancheConfig implements EvalancheConfigInterface
{
    /**
     * @var string
     */
    private $hostname;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $debugMode;

    /**
     * @var array<string, mixed>
     */
    private $soapClientOptions;

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param bool $debugMode
     * @param array<string, mixed> $soapClientOptions
     */
    public function __construct(
        string $hostname,
        string $username,
        string $password,
        bool $debugMode = false,
        array $soapClientOptions = []
    ) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->debugMode = $debugMode;
        $this->soapClientOptions = $soapClientOptions;
    }

    /**
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $wsdlUri
     *
     * @return string
     */
    public function getWsdlServiceUrl(string $wsdlUri): string
    {
        return sprintf('https://%s/%s', $this->getHostname(), $wsdlUri);
    }

    /**
     *
     * @return bool
     */
    public function getDebugMode(): bool
    {
        return $this->debugMode;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSoapClientOptions(): array
    {
        return $this->soapClientOptions;
    }

    /**
     *
     * @return string
     */
    private function getHostname(): string
    {
        return $this->hostname;
    }
}
