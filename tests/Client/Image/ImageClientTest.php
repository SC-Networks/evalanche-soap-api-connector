<?php

namespace Scn\EvalancheSoapApiConnector\Client\Image;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatusInterface;

/**
 * Class ImageClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Image
 */
class ImageClientTest extends TestCase
{
    /**
     * @var ImageClient
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
            'create',
            'copy',
            'delete',
            'getAll',
            'getByCategory',
            'getByExternalId',
            'getById',
            'getByTypeId',
            'getResourceDefaultCategory',
            'getTypeIds',
            'move',
            'isAlive'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ImageClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateCanReturnInstanceOfResourceInformation()
    {
        $image = base64_encode('some image');
        $title = 'some title';
        $folderId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('create')->with([
            'name' => $title,
            'category_id' => $folderId,
            'image_base64' => $image
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'createResult',
            $config)->willReturn($response->createResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($image, $title, $folderId)
        );
    }

    public function testCopyCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $folderId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->copyResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('copy')->with([
            'resource_id' => $id,
            'category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'copyResult',
            $config)->willReturn($response->copyResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->copy($id, $folderId)
        );
    }

    public function testDeleteCanReturnBoolean()
    {
        $id = 56;

        $response = new \stdClass();
        $response->deleteResult = true;

        $this->soapClient->expects($this->once())->method('delete')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'deleteResult')->willReturn($response->deleteResult);

        $this->assertTrue($this->subject->delete($id));
    }

    public function testGetListByMandatorIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAllResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAll')->with(['mandator_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getAllResult',
            $config)->willReturn($response->getAllResult);

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

        $response = new \stdClass();
        $response->getByCategoryResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByCategory')->with(['category_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getByCategoryResult',
            $config)->willReturn($response->getByCategoryResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByFolderId($id)
        );
    }

    public function testGetByExternalIdCanReturnInstanceOfResourceInformation()
    {
        $id = 'some id';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByExternalId')->with(['external_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getByExternalIdResult',
            $config)->willReturn($response->getByExternalIdResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getByExternalId($id)
        );
    }

    public function testGetByIdCanReturnInstanceOfResourceInformation()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getById')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getByIdResult',
            $config)->willReturn($response->getByExternalIdResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getById($id)
        );
    }

    public function testGetByTypeIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;
        $mandatorId = 76;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByTypeIdResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByTypeId')->with([
            'type_id' => $id,
            'mandator_id' => $mandatorId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getByTypeIdResult',
            $config)->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByTypeId($id, $mandatorId)
        );
    }

    public function testGetDefaultFolderByMandatorIdCanReturnInstanceOfFolderInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FolderInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getResourceDefaultCategoryResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getResourceDefaultCategory')->with(['customer_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getResourceDefaultCategoryResult',
            $config)->willReturn($response->getResourceDefaultCategoryResult);

        $this->assertInstanceOf(
            FolderInformationInterface::class,
            $this->subject->getDefaultFolderByMandatorId($id)
        );
    }

    public function testGetTypeIdsCanReturnArrayOfResourceTypeInformation()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByTypeIdResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceTypeInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getTypeIds')->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getTypeIdsResult',
            $config)->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceTypeInformationInterface::class,
            $this->subject->getTypeIds()
        );
    }

    public function testMoveCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $folderId = 34;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->moveResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('move')->with(['resource_id' => $id, 'category_id' => $folderId])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'moveResult',
            $config)->willReturn($response->moveResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->move($id, $folderId)
        );
    }

    public function testGetServiceAvailableCanReturnInstanceOfServiceStatus()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ServiceStatusInterface::class)->getMock();

        $response = new \stdClass();
        $response->isAliveResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createServiceStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('isAlive')->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'isAliveResult',
            $config)->willReturn($response->isAliveResult);

        $this->assertInstanceOf(
            ServiceStatusInterface::class,
            $this->subject->getServiceAvailable()
        );
    }
}
