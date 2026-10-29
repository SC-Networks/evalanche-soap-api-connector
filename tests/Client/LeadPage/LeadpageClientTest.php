<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPage;

use Scn\EvalancheSoapApiConnector\TestCase;
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
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticleInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfigurationInterface;
use \stdClass;

class LeadpageClientTest extends TestCase
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
            'getByModificationDate',
            'getByExternalId',
            'getContentContainerData',
            'setContentContainerData',
            'updateModuleTypes',
            'retrieveModuleTypes',
            'removeAllArticles',
            'removeArticles',
            'getArticles',
            'addArticles',
        ]);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

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
        $configuration = $this->createStub(LeadpageConfigurationInterface::class);

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(LeadpageConfigurationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(LeadpageConfigurationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

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
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceTypeInformationInterface::class);
        $otherObject = $this->createStub(ResourceTypeInformationInterface::class);

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

    public function testGetByFolderIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $otherObject = $this->createStub(ResourceInformationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(FolderInformationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(HashMapInterface::class);

        $response = new stdClass();
        $response->getContentContainerDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createHashMapConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getContentContainerData')
            ->with(['resource_id' => $id])->willReturn($response);

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

        $hashMapConfig = $this->createStub(HydratorConfigInterface::class);
        $resourceInformationConfig = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $hashMap = $this->createStub(HashMapInterface::class);

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
                'resource_id' => $id,
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


        self::assertTrue($this->subject->updateModuleTypes($id, $moduleTypeContent));
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


        self::assertSame('some-thing', $this->subject->getModuleTypes($id));
    }

    public function testRemoveAllArticlesCalls(): void
    {
        $id = 23;

        $response = new stdClass();
        $response->removeAllArticleResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeAllArticles')
            ->with([
                'leadpage_id' => $id
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'removeAllArticlesResult'
            )
            ->willReturn($response->removeAllArticleResult);


        self::assertTrue(
            $this->subject->removeAllArticles($id)
        );
    }

    public function testRemoveArticlesCalls(): void
    {
        $id = 23;
        $referenceIds = [42, 666];
        $response = new stdClass();
        $result = ['some-result'];

        $config = $this->createStub(HydratorConfigInterface::class);

        $this->soapClient->expects($this->once())
            ->method('removeArticles')
            ->with([
                'leadpage_id' => $id,
                'reference_ids' => $referenceIds,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'removeArticlesResult',
                $config,
            )
            ->willReturn($result);

        $this->hydratorConfigFactory->expects(static::once())
            ->method('createLeadpageArticleConfig')
            ->willReturn($config);

        self::assertSame(
            $result,
            $this->subject->removeArticles($id, $referenceIds)
        );
    }

    public function testAddArticlesCalls(): void
    {
        $id = 1234;
        $articles = [
            $this->createStub(LeadpageArticleInterface::class),
        ];

        $config = $this->createStub(HydratorConfigInterface::class);

        $response = new stdClass();
        $response->addArticlesResult = $articles;

        $extractedData = [
            [
                'some' => 'data'
            ],
        ];

        $this->extractor->expects($this->once())
            ->method('extractArray')
            ->with(
                $config,
                $articles
            )
            ->willReturn($extractedData);

        $this->hydratorConfigFactory->expects($this->exactly(2))
            ->method('createLeadpageArticleConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('addArticles')
            ->with([
                'leadpage_id' => $id,
                'articles' => $extractedData
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'addArticlesResult',
                $config
            )
            ->willReturn($response->addArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            LeadpageArticleInterface::class,
            $this->subject->addArticles($id, $articles)
        );
    }

    public function testGetArticlesByLeadpageIdCallsAndReturnsArticles(): void
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(LeadpageArticleInterface::class);

        $response = new stdClass();
        $response->getArticlesResult = [
            $object,
        ];

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageArticleConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getArticles')
            ->with([
                'leadpage_id' => $id,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'getArticlesResult',
                $config
            )
            ->willReturn($response->getArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            LeadpageArticleInterface::class,
            $this->subject->getArticlesByLeadpageId($id)
        );
    }
}
