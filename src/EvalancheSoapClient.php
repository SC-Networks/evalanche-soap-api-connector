<?php

namespace Scn\EvalancheSoapApiConnector;

use Scn\EvalancheSoapApiConnector\Exception\DebugRequestException;
use Scn\EvalancheSoapApiConnector\Exception\RequestException;

/**
 * Class EvalancheSoapClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client
 */
class EvalancheSoapClient extends \SoapClient
{
    /**
     * @var bool
     */
    private $debugMode;

    /**
     * @param string $wsdl
     * @param array $options
     * @param bool $debugMode
     */
    public function __construct(string $wsdl, array $options, bool $debugMode = false)
    {
        parent::__construct($wsdl, $options);
        $this->debugMode = $debugMode;
    }

    /**
     * @param bool $debugMode
     *
     * @return EvalancheSoapClient
     */
    public function setDebugMode(bool $debugMode): EvalancheSoapClient
    {
        $this->debugMode = $debugMode;
        return $this;
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
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     * @throws DebugRequestException
     * @throws RequestException
     */
    public function __call($method, $arguments = [])
    {
        try {
            return $this->__soapCall($method, $arguments);
        } catch (\SoapFault $exception) {
            if ($this->getDebugMode() === false) {
                throw new RequestException($exception->getMessage());
            } else {
                throw new DebugRequestException(
                    sprintf(
                        'Message: %s ' . PHP_EOL . 'Request: %s ' . PHP_EOL . 'Response: %s',
                        $exception->getMessage(),
                        $this->__getLastRequest(),
                        $this->__getLastResponse()
                    )
                );
            }
        }
    }
}
