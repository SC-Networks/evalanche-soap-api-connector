<?php

namespace Scn\EvalancheSoapApiConnector\Client\Report;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;

/**
 * Class ReportClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Report
 */
final class ReportClient extends AbstractClient implements ReportClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'report';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param int $reportId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function addResourceIdToReport(int $id, int $reportId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->addResourceToReport([
                'resource_id' => $id,
                'report_id' => $reportId
            ]),
            'addResourceToReportResult'
        );
    }
}
