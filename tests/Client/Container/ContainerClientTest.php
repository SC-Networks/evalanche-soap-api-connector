<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use stdClass;

/**
 * Class ContainerClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
class ContainerClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var ContainerClient
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
            'create',
            'getData',
            'update',
            'getDetails',
            'getByContainerTypeId',
            'rename',
            'move',
            'copy',
            'delete',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ContainerClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $title = 'some title';
        $folderId = 123;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $expectedExtractor = [
            'some' => 'value'
        ];

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);

        $this->extractor->expects($this->once())->method('extract')->with(
            $config,
            $hashMap
        )->willReturn($expectedExtractor);

        $this->soapClient->expects($this->once())->method('create')->with([
            'container_preset_id' => $id,
            'name' => $title,
            'category_id' => $folderId,
            'data' => $expectedExtractor,
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createResult',
            $config
        )->willReturn($response->createResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($id, $title, $folderId, $hashMap)
        );
    }

    public function testGetDetailByIdCanReturnInstanceOfHashMap()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new stdClass();
        $response->getDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getData')->with(['container_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDataResult',
            $config
        )->willReturn($response->getDataResult);

        $this->assertInstanceOf(
            HashMapInterface::class,
            $this->subject->getDetailById($id)
        );
    }

    public function testUpdateCanReturnInstanceOfResourceInformation()
    {
        $id = 123;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getDataResult = $object;

        $extractedData = [
            'some key' => 'some value',
            'some other key' => 'some other value'
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with(
            $config,
            $hashMap
        )->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('update')->with([
            'container_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'updateResult',
            $config
        )->willReturn($response->getDataResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->update($id, $hashMap)
        );
    }

    public function testGetDetailsByIdCanReturnInstanceOfContainerDetail()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerDetailInterface::class)->getMock();

        $response = new stdClass();
        $response->getDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerDetailConfig')->willReturn($config);


        $this->soapClient->expects($this->once())->method('getDetails')->with([
            'container_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDetailsResult',
            $config
        )->willReturn($response->getDataResult);

        $this->assertInstanceOf(
            ContainerDetailInterface::class,
            $this->subject->getDetailsById($id)
        );
    }

    public function testGetByContainerTypeIdCanReturnInstancesOfResourceInformation()
    {
        $containerTypeId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getByContainerTypeIdResult = [$object, $otherObject];

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);

        $this->soapClient
            ->expects($this->once())
            ->method('getByContainerTypeId')
            ->with(['container_type_id' => $containerTypeId])
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getObjects')
            ->with($response, 'getByContainerTypeIdResult', $config)
            ->willReturn($response->getByContainerTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByContainerTypeId($containerTypeId)
        );
    }
}
