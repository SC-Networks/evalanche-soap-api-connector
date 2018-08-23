<?php

namespace Scn\EvalancheSoapApiConnector\Client\Scoring;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetailInterface;

/**
 * Interface ScoringClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Scoring
 */
interface ScoringClientInterface extends ClientInterface
{
    /**
     * @param int $id
     *
     * @return ScoringGroupDetailInterface[]
     */
    public function getListByMandatorId(int $id): array;
}