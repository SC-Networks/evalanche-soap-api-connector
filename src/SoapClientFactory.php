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
     * Merges soap settings and creates a new evalanche soap client instance
     * Order of soap settings:
     * - default
     * - user-defined
     * - debug
     * - pre-defined
     *
     * @param EvalancheConfigInterface $config
     * @param string $wsdlUri
     *
     * @return EvalancheSoapClient
     */
    public function create(
        EvalancheConfigInterface $config,
        string $wsdlUri
    ): EvalancheSoapClient {
        $soapSettings = array_merge(
            [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
            $config->getSoapClientOptions(),
            $this->getDebugSettings($config),
            [
                'login' => $config->getUsername(),
                'password' => $config->getPassword(),
                'style' => SOAP_DOCUMENT,
                'use' => SOAP_LITERAL,
                'soap_version' => SOAP_1_1,
            ]
        );

        return new EvalancheSoapClient(
            $config->getWsdlServiceUrl($wsdlUri),
            $soapSettings,
            $config->getDebugMode()
        );
    }

    /**
     * @param EvalancheConfigInterface $config
     *
     * @return array<string, mixed>
     */
    private function getDebugSettings(
        EvalancheConfigInterface $config
    ): array {
        if ($config->getDebugMode() === false) {
            return [];
        }

        return [
            'trace' => true,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ])
        ];
    }
}
