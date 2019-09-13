<?php

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class ContainerClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
class ContainerClientTest extends TestCase
{
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
            'getData',
            'update',
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

    public function testGetDetailByIdCanReturnInstanceOfHashMap()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
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

        $response = new \stdClass();
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
}
