<?php

declare(strict_types=1);

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
    public function addResourceIdToReport(int $id, int $reportId): bool;
}
