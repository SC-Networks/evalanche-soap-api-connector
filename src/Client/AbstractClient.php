<?php

namespace Scn\EvalancheSoapApiConnector\Client;

use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use SoapClient;

/**
 * Class AbstractClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client
 */
abstract class AbstractClient
{
    const PORTNAME = '';
    const VERSION = '';

    /**
     * @var SoapClient
     */
    protected $soapClient;

    /**
     * @var ResponseMapperInterface
     */
    protected $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface
     */
    protected $hydratorConfigFactory;

    /**
     * @var ExtractorInterface
     */
    protected $extractor;

    final public function __construct(
        SoapClient $soapClient,
        ResponseMapperInterface $responseMapper,
        HydratorConfigFactoryInterface $hydratorConfigFactory,
        ExtractorInterface $extractor
    ) {
        $this->soapClient = $soapClient;
        $this->responseMapper = $responseMapper;
        $this->hydratorConfigFactory = $hydratorConfigFactory;
        $this->extractor = $extractor;
    }

    public static function getWsdlUri(): string
    {
        return sprintf(ClientInterface::WSDL_DEFAULT_URI, static::VERSION, static::PORTNAME);
    }
}
