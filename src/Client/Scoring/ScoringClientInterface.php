<?php

declare(strict_types=1);

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
     *
     * @return ScoringGroupDetailInterface[]
     */
    public function getListByMandatorId(int $id): array;
}
