<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

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

    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->rename(['resource_id' => $id, 'name' => $title]),
            'renameResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
