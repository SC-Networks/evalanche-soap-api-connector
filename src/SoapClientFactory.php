<?php

namespace Scn\EvalancheSoapApiConnector;

/**
 * Class SoapClientFactory
 *
 * @package Scn\EvalancheSoapApiConnector
 */
final class SoapClientFactory implements SoapClientFactoryInterface
{
    /**
     * @param EvalancheConfigInterface $config
     * @param string $wsdlUri
     *
     * @return EvalancheSoapClient
     */
    public function create(EvalancheConfigInterface $config, string $wsdlUri): EvalancheSoapClient
    {
        $soapSettings = [
            'login' => $config->getUsername(),
            'password' => $config->getPassword(),
            'style' => SOAP_DOCUMENT,
            'use' => SOAP_LITERAL,
            'soap_version' => SOAP_1_1,
            'cache_wsdl' => WSDL_CACHE_NONE,
        ];

        $debug = $config->getDebugMode();

        if ($debug === true) {
            $soapSettings = array_merge($soapSettings, $this->getDebugSettings());
        }

        $soapClient = new EvalancheSoapClient(
            $config->getWsdlServiceUrl($wsdlUri),
            $soapSettings,
            $debug
        );

        return $soapClient;
    }

    /**
     *
     * @return array
     */
    private function getDebugSettings(): array
    {
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        return [
            'trace' => true,
            'stream_context' => $context
        ];
    }
}
