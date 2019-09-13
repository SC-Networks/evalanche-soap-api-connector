<?php

namespace Scn\EvalancheSoapApiConnector\Client\Scoring;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetailInterface;

/**
 * Class ScoringClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Scoring
 */
final class ScoringClient extends AbstractClient implements ScoringClientInterface
{
    const PORTNAME = 'scoring';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * Returns the configured scoring groups
     *
     * @param int $id
     *
     * @return ScoringGroupDetailInterface[]
     * @throws EmptyResultException
     */
    public function getListByMandatorId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getGroups(['mandator_id' => $id]),
            'getGroupsResult',
            $this->hydratorConfigFactory->createScoringGroupDetailConfig()
        );
    }
}
