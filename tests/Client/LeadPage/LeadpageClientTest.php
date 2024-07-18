<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPage;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfigurationInterface;
use \stdClass;

class LeadpageClientTest extends \Scn\EvalancheSoapApiConnector\TestCase
{
    use CommonResourceMethodsTestTrait;

    private LeadpageClientInterface $subject;

    private EvalancheSoapClient|MockObject $soapClient;

    private ResponseMapperInterface&MockObject $responseMapper;

    private HydratorConfigFactoryInterface&MockObject $hydratorConfigFactory;

    private ExtractorInterface&MockObject $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock([
            'getByTypeId',
            'getConfiguration',
            'getDetails',
            'getTypeIds',
            'move',
            'rename',
            'setConfiguration',
            'delete',
            'copy',
            'getAll',
            'getByCategory',
            'getById',
            'getResourceDefaultCategory',
            'getByExternalId',
            'getContentContainerData',
            'setContentContainerData',
            'updateModuleTypes',
            'retrieveModuleTypes'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new LeadpageClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testSetConfigurationCanReturnInstanceOfLeadpageConfiguration()
    {
        $id = 123;
        $configuration = $this->getMockBuilder(LeadpageConfigurationInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(LeadpageConfigurationInterface::class)->getMock();

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new stdClass();
        $response->setConfigurationResult = $object;

        $this->extractor->expects($this->once())->method('extract')->with($config, $configuration)->willReturn($extractedData);
        $this->hydratorConfigFactory->expects($this->exactly(2))->method('createLeadpageConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('setConfiguration')->with([
            'leadpage_id' => $id,
            'configuration' => $extractedData,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'setConfigurationResult',
            $config
        )->willReturn($response->setConfigurationResult);

        self::assertInstanceOf(
            LeadpageConfigurationInterface::class,
            $this->subject->setConfiguration($id, $configuration)
        );
    }

    public function testGetByTypeIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;
        $mandatorId = 76;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getByTypeIdResult = [
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByTypeId')->with([
            'type_id' => $id,
            'mandator_id' => $mandatorId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getByTypeIdResult',
            $config
        )->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByTypeId($id, $mandatorId)
        );
    }

    public function testGetConfigurationCanReturnInstanceOfLeadpageConfiguration()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(LeadpageConfigurationInterface::class)->getMock();

        $response = new stdClass();
        $response->getConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createLeadpageConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getConfiguration')->with([
            'leadpage_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getConfigurationResult',
            $config
        )->willReturn($response->getConfigurationResult);

        self::assertInstanceOf(
            LeadpageConfigurationInterface::class,
            $this->subject->getConfiguration($id)
        );
    }

    public function testGetDetailsByIdCanReturnIsntanceOfResourceInformation()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getDetailsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getDetails')->with([
            'leadpage_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDetailsResult',
            $config
        )->willReturn($response->getDetailsResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getDetailsById($id)
        );
    }

    public function testUpdateTitleCanReturnInstanceOfResourceInformationInterface()
    {
        $id = 123;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->renameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('rename')->with([
            'resource_id' => $id,
            'name' => $title,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'renameResult',
            $config
        )->willReturn($response->renameResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->updateTitle($id, $title)
        );
    }

    public function testGetTypeIdsCanReturnArrayOfResourceInformation()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getByTypeIdResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceTypeInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getTypeIds')->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getTypeIdsResult',
            $config
        )->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceTypeInformationInterface::class,
            $this->subject->getTypeIds()
        );
    }

    public function testGetListByMandatorIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getAllResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAll')->with(['mandator_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getAllResult',
            $config
        )->willReturn($response->getAllResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getListByMandatorId($id)
        );
    }

    public function testGetByFolderIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getByCategoryResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByCategory')->with(['category_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getByCategoryResult',
            $config
        )->willReturn($response->getByCategoryResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByFolderId($id)
        );
    }

    public function testGetByIdCanReturnInstanceOfResourceInformation()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getById')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getByIdResult',
            $config
        )->willReturn($response->getByExternalIdResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getById($id)
        );
    }

    public function testGetDefaultFolderByMandatorIdCanReturnInstanceOfFolderInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FolderInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getResourceDefaultCategoryResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getResourceDefaultCategory')->with(['customer_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getResourceDefaultCategoryResult',
            $config
        )->willReturn($response->getResourceDefaultCategoryResult);

        self::assertInstanceOf(
            FolderInformationInterface::class,
            $this->subject->getDefaultFolderByMandatorId($id)
        );
    }

    public function testGetByExternalIdCanReturnInstanceOfResourceInformation()
    {
        $id = 'some id';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByExternalId')->with(['external_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getByExternalIdResult',
            $config
        )->willReturn($response->getByExternalIdResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getByExternalId($id)
        );
    }

    public function testGetContentContainerDataReturnsData(): void
    {
        $id = 666;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new stdClass();
        $response->getContentContainerDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createHashMapConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getContentContainerData')
            ->with(['leadpage_id' => $id])->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getContentContainerDataResult',
                $config
            )
            ->willReturn($response->getContentContainerDataResult);

        self::assertSame(
            $object,
            $this->subject->getContentContainerData($id)
        );
    }

    public function testSetContentContainerDataSetsData(): void
    {
        $id = 666;
        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $hashMapConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $resourceInformationConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new stdClass();
        $response->setContentContainerDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createHashMapConfig')
            ->willReturn($hashMapConfig);
        $this->hydratorConfigFactory->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($resourceInformationConfig);

        $this->soapClient->expects($this->once())
            ->method('setContentContainerData')
            ->with([
                'leadpage_id' => $id,
                'data' => $extractedData
            ])->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'setContentContainerDataResult',
                $resourceInformationConfig
            )
            ->willReturn($response->setContentContainerDataResult);

        $this->extractor->expects($this->once())
            ->method('extract')
            ->with(
                $hashMapConfig,
                $hashMap
            )
            ->willReturn($extractedData);

        self::assertSame(
            $object,
            $this->subject->setContentContainerData($id, $hashMap)
        );
    }

    public function testUpdateModuleTypesCanReturnBool(): void
    {
        $id = 23;
        $moduleTypeContent = 'some-thing';

        $response = new stdClass();
        $response->updateModuleTypesResult = true;

        $this->soapClient->expects($this->once())->method('updateModuleTypes')->with([
            'resource_id' => $id,
            'module_type_content' => $moduleTypeContent
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'updateModuleTypesResult'
        )->willReturn($response->updateModuleTypesResult);


        static::assertTrue($this->subject->updateModuleTypes($id, $moduleTypeContent));
    }

    public function testGetModuleTypesCanReturnString(): void
    {
        $id = 23;

        $response = new stdClass();
        $response->retrieveModuleTypesResult = 'some-thing';

        $this->soapClient->expects($this->once())->method('retrieveModuleTypes')->with([
            'resource_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getString')->with(
            $response,
            'retrieveModuleTypesResult'
        )->willReturn($response->retrieveModuleTypesResult);


        static::assertSame('some-thing', $this->subject->getModuleTypes($id));
    }
}
