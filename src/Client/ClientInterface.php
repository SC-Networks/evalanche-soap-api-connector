<?php

namespace Scn\EvalancheSoapApiConnector\Client;

/**
 * Interface ClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client
 */
interface ClientInterface
{
    const WSDL_DEFAULT_URI = 'soap.php/%s/wsdl/%s';
    const WSDL_V1_URI = 'api/soap/%s/%s';
    const VERSION_V0 = 'v0';
    const VERSION_V1 = 'v1';

    /**
     *
     * @return string
     */
    public static function getWsdlUri(): string;
}
