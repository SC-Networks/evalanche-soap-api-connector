<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Report;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use stdClass;

/**
 * Class ReportClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Report
 */
class ReportClientTest extends TestCase
{
    /**
     * @var ReportClient
     */
    private $subject;

    /**
     * @var EvalancheSoapClient|MockObject
     */
    private $soapClient;

    /**
     * @var ResponseMapperInterface|MockObject
     */
    private $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface|MockObject
     */
    private $hydratorConfigFactory;

    /**
     * @var ExtractorInterface|MockObject
     */
    private $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock(['addResourceToReport']);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ReportClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testAddResourceToReportCanReturnBoolean()
    {
        $id = 123;
        $reportId = 555;

        $response = new stdClass();
        $response->addResourceToReportResult = true;

        $this->soapClient->expects($this->once())->method('addResourceToReport')->with([
            'resource_id' => $id,
            'report_id' => $reportId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'addResourceToReportResult'
        )->willReturn($response->addResourceToReportResult);

        $this->assertTrue($this->subject->addResourceIdToReport($id, $reportId));
    }
}
