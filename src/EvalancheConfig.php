<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

/**
 * Class EvalancheConfig
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class EvalancheConfig implements EvalancheConfigInterface
{
    /**
     * @param array<string, mixed> $soapClientOptions
     */
    public function __construct(private readonly string $hostname, private readonly string $username, private readonly string $password, private readonly bool $debugMode = false, private readonly array $soapClientOptions = [])
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getWsdlServiceUrl(string $wsdlUri): string
    {
        return sprintf('https://%s/%s', $this->getHostname(), $wsdlUri);
    }

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

    private function getHostname(): string
    {
        return $this->hostname;
    }
}
