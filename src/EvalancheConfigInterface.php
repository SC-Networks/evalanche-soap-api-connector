<?php

namespace Scn\EvalancheSoapApiConnector;

/**
 * Interface EvalancheConfigInterface
 *
 * @package Scn\EvalancheSoapApiConnector
 */
interface EvalancheConfigInterface
{
    /**
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     *
     * @return string
     */
    public function getPassword(): string;

    /**
     * @param string $wsdlUri
     *
     * @return string
     */
    public function getWsdlServiceUrl(string $wsdlUri): string;

    /**
     *
     * @return bool
     */
    public function getDebugMode(): bool;

    /**
     * @return array<string, mixed>
     */
    public function getSoapClientOptions(): array;
}
