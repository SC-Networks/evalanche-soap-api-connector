<?php

namespace Scn\EvalancheSoapApiConnector\Client\Document;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;

/**
 * Interface DocumentClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Document
 */
interface DocumentClientInterface extends ClientInterface, ResourceTraitInterface, CreateResourceTraitInterface
{
}
