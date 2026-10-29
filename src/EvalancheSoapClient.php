<?php

namespace Scn\EvalancheSoapApiConnector;

use ReturnTypeWillChange;
use Scn\EvalancheSoapApiConnector\Exception\DebugRequestException;
use Scn\EvalancheSoapApiConnector\Exception\RequestException;
use SoapClient;
use SoapFault;

/**
 * Class EvalancheSoapClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client
 */
class EvalancheSoapClient extends SoapClient
{
    /**
     *
     * @throws SoapFault
     */
    public function __construct(string $wsdl, array $options, private bool $debugMode = false)
    {
        @parent::__construct($wsdl, $options);
    }

    public function setDebugMode(bool $debugMode): EvalancheSoapClient
    {
        $this->debugMode = $debugMode;
        return $this;
    }

    public function getDebugMode(): bool
    {
        return $this->debugMode;
    }

    /**
     * @param string $name
     * @param array $args
     *
     * @throws DebugRequestException
     * @throws RequestException
     */
    #[ReturnTypeWillChange]
    public function __call($name, $args = []): mixed
    {
        try {
            return $this->__soapCall($name, $args);
        } catch (SoapFault $exception) {
            if ($this->getDebugMode() === false) {
                throw new RequestException($exception->getMessage(), $exception->getCode(), $exception);
            }
            throw new DebugRequestException(sprintf(
                'Message: %s ' . PHP_EOL . 'Request: %s ' . PHP_EOL . 'Response: %s',
                $exception->getMessage(),
                $this->__getLastRequest(),
                $this->__getLastResponse()
            ), $exception->getCode(), $exception);
        }
    }
}
