<?php

namespace Scn\EvalancheSoapApiConnector\Client\Report;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;

/**
 * Interface ReportClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Report
 */
interface ReportClientInterface extends ClientInterface, ResourceTraitInterface, CreateResourceTraitInterface
{
    /**
     * @param int $id
     * @param int $reportId
     *
     * @return bool
     */
    public function addResourceIdToReport(int $id, int $reportId): bool;
}
