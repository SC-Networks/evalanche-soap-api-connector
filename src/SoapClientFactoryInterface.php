<?php

namespace Scn\EvalancheSoapApiConnector;

/**
 * Interface SoapClientFactoryInterface
 *
 * @package Scn\EvalancheSoapApiConnector
 */
interface SoapClientFactoryInterface
{
    /**
     * @param EvalancheConfigInterface $config
     * @param string $wsdlUri
     *
     * @return EvalancheSoapClient
     */
    public function create(
        EvalancheConfigInterface $config,
        string $wsdlUri
    ): EvalancheSoapClient;
}
