<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Report;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
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
    use CommonResourceMethodsTestTrait;
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
     * @var Stub&HydratorConfigFactoryInterface
     */
    private Stub $hydratorConfigFactory;

    /**
     * @var Stub&ExtractorInterface
     */
    private Stub $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock([
            'getAll',
            'getByModificationDate',
            'addResourceToReport',
            'rename',
            'move',
            'copy',
            'delete',
        ]);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createStub(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createStub(ExtractorInterface::class);

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
