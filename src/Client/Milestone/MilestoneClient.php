<?php

namespace Scn\EvalancheSoapApiConnector\Client\Milestone;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class MilestoneClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Milestone
 */
final class MilestoneClient extends AbstractClient implements MilestoneClientInterface
{
    const PORTNAME = 'milestone';
    const VERSION = ClientInterface::VERSION_V0;

    use ResourceTrait;

    /**
     * @param string $name
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $name, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(['name' => $name, 'category_id' => $folderId]),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
