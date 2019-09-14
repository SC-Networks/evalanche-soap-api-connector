<?php

namespace Scn\EvalancheSoapApiConnector\Client\Document;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;

/**
 * Class DocumentClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Document
 */
final class DocumentClient extends AbstractClient implements DocumentClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'document';
    const VERSION = ClientInterface::VERSION_V0;
}
