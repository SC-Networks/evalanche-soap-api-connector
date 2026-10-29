<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

/**
 * Interface EvalancheConfigInterface
 *
 * @package Scn\EvalancheSoapApiConnector
 */
interface EvalancheConfigInterface
{
    public function getUsername(): string;

    public function getPassword(): string;

    public function getWsdlServiceUrl(string $wsdlUri): string;

    public function getDebugMode(): bool;

    /**
     * @return array<string, mixed>
     */
    public function getSoapClientOptions(): array;
}
