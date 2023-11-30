<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResultInterface;
use stdClass;

/**
 * Class WorkflowClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Workflow
 */
class WorkflowClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
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

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock([
            'getByStartDateRange',
            'getByEndDateRange',
            'getDetails',
            'pushProfilesIntoCampaign',
            'createConfigured',
            'export',
            'setConfiguration',
            'getConfiguration',
            'activate',
            'deactivate',
            'getConfigurationVersions',
            'copy',
            'move',
            'delete',
            'rename',
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

        $result = new stdClass();
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
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $result,
            'getByStartDateRangeResult',
            $config
        )->willReturn([$object, $otherObject]);

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

        $result = new stdClass();
        $result->getByEndDateRangeResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')
            ->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByEndDateRange')->with([
            'from' => $timestampStart,
            'to' => $timestampEnd
        ])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $result,
            'getByEndDateRangeResult',
            $config
        )->willReturn([$object, $otherObject]);

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

        $result = new stdClass();
        $result->getDetailsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createWorkflowDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getDetails')->with(['resource_id' => $id])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObject')->with($result)->willReturn($object);

        self::assertInstanceOf(
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

        $result = new stdClass();
        $result->pushProfilesIntoCampaignResult = true;

        $this->soapClient->expects($this->once())->method('pushProfilesIntoCampaign')->with([
            'resource_id' => $id,
            'profile_id_list' => $profileIds
        ])->willReturn($result);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with()->willReturn(true);
        $this->assertTrue($this->subject->pushProfilesIntoCampaign($id, $profileIds));
    }

    public function testCreateConfiguredReturnsResourceInformation()
    {
        $name = 'some-name';
        $schemaVersion = 1;
        $workflowConfiguration = 'my config';
        $categoryId = 456;

        $resourceInformation = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $result = new stdClass();
        $result->createResult = $resourceInformation;

        $this->soapClient->expects($this->once())->method('createConfigured')->with([
            'name' => $name,
            'schema_version' => $schemaVersion,
            'configuration' => $workflowConfiguration,
            'category_id' => $categoryId,
        ])->willReturn($result);

        $resourceInformationConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createResourceInformationConfig')
            ->with()
            ->willReturn($resourceInformationConfig);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'createConfiguredResult', $resourceInformationConfig)
            ->willReturn($resourceInformation);
        self::assertSame(
            $resourceInformation,
            $this->subject->createConfigured($name, $schemaVersion, $workflowConfiguration, $categoryId)
        );
    }

    public function testExportReturnString()
    {
        $workflowId = 42;

        $result_string = 'my result';
        $result = new stdClass();

        $this->soapClient->expects($this->once())
            ->method('export')
            ->with([
                'workflow_id' => $workflowId,
            ])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getString')
            ->with($result, 'exportResult')
            ->willReturn($result_string);
        
        self::assertSame(
            $result_string,
            $this->subject->export($workflowId)
        );
    }

    public function testSetConfigurationSets(): void
    {
        $workflowId = 42;
        $configVersion = 'some-config-version';
        $configuration = 'some-configuration';

        $resultString = 'my result';
        $result = new stdClass();

        $this->soapClient->expects($this->once())
            ->method('setConfiguration')
            ->with([
                'workflow_id' => $workflowId,
                'config_version' => $configVersion,
                'configuration' => $configuration,
            ])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getString')
            ->with($result, 'setConfigurationResult')
            ->willReturn($resultString);

        self::assertSame(
            $resultString,
            $this->subject->setConfiguration($workflowId, $configVersion, $configuration)
        );
    }

    public function testGetConfigurationVersionsReturnsResults(): void
    {
        $workflowId = 42;

        $configResult = ['my result'];
        $result = new stdClass();
        $configVersionsConfig = $this->createMock(HydratorConfigInterface::class);

        $this->soapClient->expects($this->once())
            ->method('getConfigurationVersions')
            ->with([
                'workflow_id' => $workflowId,
            ])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObjects')
            ->with($result, 'getConfigurationVersionsResult', $configVersionsConfig)
            ->willReturn($configResult);
        
        $this->hydratorConfigFactory->expects($this->once())
            ->method('createWorkflowConfigVersionConfig')
            ->willReturn($configVersionsConfig);

        self::assertSame(
            $configResult,
            $this->subject->getConfigurationVersions($workflowId)
        );
    }

    public function testActivateActivates(): void
    {
        $workflowId = 42;

        $configResult = $this->createMock(WorkflowStateChangeResultInterface::class);
        $result = new stdClass();
        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);

        $this->soapClient->expects($this->once())
            ->method('activate')
            ->with([
                'workflow_id' => $workflowId,
            ])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'activateResult', $hydratorConfig)
            ->willReturn($configResult);

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createWorkflowStateChangeResultConfig')
            ->willReturn($hydratorConfig);

        self::assertSame(
            $configResult,
            $this->subject->activate($workflowId)
        );
    }

    public function testDeactivateDeactivates(): void
    {
        $workflowId = 42;

        $configResult = $this->createMock(WorkflowStateChangeResultInterface::class);
        $result = new stdClass();
        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);

        $this->soapClient->expects($this->once())
            ->method('deactivate')
            ->with([
                'workflow_id' => $workflowId,
            ])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'deactivateResult', $hydratorConfig)
            ->willReturn($configResult);

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createWorkflowStateChangeResultConfig')
            ->willReturn($hydratorConfig);

        self::assertSame(
            $configResult,
            $this->subject->deactivate($workflowId)
        );
    }

    public function testGetConfigurationReturnsResult(): void
    {
        $workflowId = 42;

        $configResult = $this->createMock(WorkflowConfigurationInterface::class);
        $result = new stdClass();
        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);

        $this->soapClient->expects($this->once())
            ->method('getConfiguration')
            ->with([
                'workflow_id' => $workflowId,
            ])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'getConfigurationResult', $hydratorConfig)
            ->willReturn($configResult);

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createWorkflowConfigurationConfig')
            ->willReturn($hydratorConfig);

        self::assertSame(
            $configResult,
            $this->subject->getConfiguration($workflowId)
        );
    }
}
