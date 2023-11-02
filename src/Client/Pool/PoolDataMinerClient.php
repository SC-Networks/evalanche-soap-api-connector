<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;

/**
 * Class PoolDataMinerClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Pool
 */
final class PoolDataMinerClient extends AbstractClient implements PoolDataMinerClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'pooldataminer';
    const VERSION = ClientInterface::VERSION_V0;
}
