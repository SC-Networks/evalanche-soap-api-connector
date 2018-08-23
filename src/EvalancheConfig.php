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
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param bool $debugMode
     */
    public function __construct(
        string $hostname,
        string $username,
        string $password,
        bool $debugMode = false
    ) {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->debugMode = $debugMode;
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
     *
     * @return string
     */
    private function getHostname(): string
    {
        return $this->hostname;
    }
}