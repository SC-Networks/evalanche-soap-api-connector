<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

/**
 * Interface SoapClientFactoryInterface
 *
 * @package Scn\EvalancheSoapApiConnector
 */
interface SoapClientFactoryInterface
{
    public function create(
        EvalancheConfigInterface $config,
        string $wsdlUri
    ): EvalancheSoapClient;
}
