<?php

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;

/**
 * Class WorkflowClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Workflow
 */
class WorkflowClientTest extends TestCase
{
    /**
     * @var WorkflowClient
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

    public function setUp()
    {
        $this->soapClient = $this->getWsdlMock([
            'getByStartDateRange',
            'getByEndateRange',
            'getDetails',
            'pushProfilesIntoCampaign',
            'createConfigured',
            'export'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new WorkflowClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetByStartRangeCanReturnArrayOfResourceInformation()
    {
        $timestampStart = 1532610558;
        $timestampEnd = 1532610558;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $result = new \stdClass();
        $result->getByEndateRangeResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')
            ->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByStartDateRange')->with([
            'from' => $timestampStart,
            'to' => $timestampEnd
        ])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($result, 'getByStartDateRangeResult',
            $config)->willReturn([$object, $otherObject]);

        $this->containsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByStartDateRange($timestampStart, $timestampEnd)
        );
    }

    public function testGetByEndDateRangeCanReturnArrayOfResourceInformation()
    {
        $timestampStart = 1532610558;
        $timestampEnd = 1532610558;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $result = new \stdClass();
        $result->getByEndateRangeResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')
            ->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByEndateRange')->with([
            'from' => $timestampStart,
            'to' => $timestampEnd
        ])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($result, 'getByEndateRangeResult',
            $config)->willReturn([$object, $otherObject]);

        $this->containsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByEndDateRange($timestampStart, $timestampEnd)
        );
    }

    public function testGetDetailByIdCanReturnInstanceOfWorkflowDetail()
    {
        $id = 55;
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(WorkflowDetailInterface::class)->getMock();

        $result = new \stdClass();
        $result->getDetailsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createWorkflowDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getDetails')->with(['resource_id' => $id])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObject')->with($result)->willReturn($object);

        $this->assertInstanceOf(
            WorkflowDetailInterface::class,
            $this->subject->getDetailById($id)
        );
    }

    public function testPushProfilesIntoCampaignCanReturnBoolean()
    {
        $id = 5;
        $profileIds = [
            4,
            5,
            6
        ];

        $result = new \stdClass();
        $result->pushProfilesIntoCampaignResult = true;

        $this->soapClient->expects($this->once())->method('pushProfilesIntoCampaign')->with([
            'resource_id' => $id,
            'profile_id_list' => $profileIds
        ])->willReturn($result);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with()->willReturn(true);
        $this->assertTrue($this->subject->pushProfilesIntoCampaign($id, $profileIds));
    }

    public function testCreateConfiguredReturnsInt()
    {
        $accountId = 123;
        $schemaVersion = 1;
        $workflowConfiguration = 'my config';

        $result_int = 42;
        $result = new \stdClass();
        $result->createResult = $result_int;

        $this->soapClient->expects($this->once())->method('createConfigured')->with([
            'account_id' => $accountId,
            'schema_version' => $schemaVersion,
            'workflow_configuration' => $workflowConfiguration,
        ])->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getInteger')
            ->with($result, 'createConfiguredResult')
            ->willReturn($result_int);
        $this->assertSame(
            $result_int,
            $this->subject->createConfigured($accountId, $schemaVersion, $workflowConfiguration)
        );
    }

    public function testExportReturnString()
    {
        $workflowId = 'my workflow';

        $result_string = 'my result';
        $result = new \stdClass();
        $result->createResult = $result_string;

        $this->soapClient->expects($this->once())->method('export')->with([
            'workflow_id' => $workflowId,
        ])->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getString')
            ->with($result, 'exportResult')
            ->willReturn($result_string);
        $this->assertSame(
            $result_string,
            $this->subject->export($workflowId)
        );
    }

}
