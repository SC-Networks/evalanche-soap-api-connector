<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeInterface;

/**
 * Class PoolClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Pool
 */
class PoolClientTest extends TestCase
{
    /**
     * @var PoolClient
     */
    private $subject;

    /**
     * @var \Scn\EvalancheSoapApiConnector\EvalancheSoapClient|MockObject
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
            'addAttribute',
            'addAttributeOptions',
            'deleteAttribute',
            'deleteAttributeOption',
            'getAttributes',
            'updateAttributeOption'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new PoolClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testAddAttributeCanReturnInstanceOfPoolAttribute()
    {
        $id = 213;
        $title = 'some title';
        $label = 'some label';
        $typeId = 145;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(PoolAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->addAttributeResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createPoolAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addAttribute')->with([
            'pool_id' => $id,
            'name' => $title,
            'label' => $label,
            'type_id' => $typeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'addAttributeResult',
            $config)->willReturn($response->addAttributeResult);

        $this->assertInstanceOf(
            PoolAttributeInterface::class,
            $this->subject->addAttribute($id, $title, $label, $typeId)
        );
    }

    public function testAddAttributeOptionsCanReturnInstanceOfPoolAttribute()
    {
        $id = 213;
        $attributeId = 777;
        $label = [
            'some text',
            'some other text',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(PoolAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->addAttributeOptionsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createPoolAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addAttributeOptions')->with([
            'pool_id' => $id,
            'attribute_id' => $attributeId,
            'labels' => $label,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'addAttributeOptionsResult',
            $config)->willReturn($response->addAttributeOptionsResult);

        $this->assertInstanceOf(
            PoolAttributeInterface::class,
            $this->subject->addAttributeOptions($id, $attributeId, $label)
        );
    }

    public function testDeleteAttributeCanReturnBool() {
        $id = 345;
        $attributeId = 456;

        $response = new \stdClass();
        $response->deleteAttributeResult = true;

        $this->soapClient->expects($this->once())
            ->method('deleteAttribute')
            ->with([
                'pool_id' => $id,
                'attribute_id' => $attributeId
            ])->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with($response, 'deleteAttributeResult')
            ->willReturn($response->deleteAttributeResult);

        $this->assertIsBool($this->subject->deleteAttribute($id, $attributeId));
    }

    public function testDeleteAttributeOptionCanReturnInstanceOfPoolAttribute()
    {
        $id = 213;
        $attributeId = 95654;
        $optionId = 145;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(PoolAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->deleteAttributeOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createPoolAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('deleteAttributeOption')->with([
            'pool_id' => $id,
            'attribute_id' => $attributeId,
            'option_id' => $optionId,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'deleteAttributeOptionResult',
            $config)->willReturn($response->deleteAttributeOptionResult);

        $this->assertInstanceOf(
            PoolAttributeInterface::class,
            $this->subject->deleteAttributeOption($id, $attributeId, $optionId)
        );
    }

    public function testGetAttributesByPoolCanReturnArrayOfPoolAttribute()
    {
        $id = 654;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(PoolAttributeInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(PoolAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAttributesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createPoolAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributes')->with([
            'pool_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getAttributesResult',
            $config)->willReturn($response->getAttributesResult);

        $this->assertContainsOnlyInstancesOf(
            PoolAttributeInterface::class,
            $this->subject->getAttributesByPool($id)
        );
    }

    public function testUpdateAttributeOptionCanReturnInstanceOfPoolAttribute()
    {
        $id = 5234;
        $attributeId = 123;
        $optionId = 5642;
        $label = 'some label';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(PoolAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->updateAttributeOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createPoolAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('updateAttributeOption')->with([
            'pool_id' => $id,
            'attribute_id' => $attributeId,
            'option_id' => $optionId,
            'label' => $label
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'updateAttributeOptionResult',
            $config)->willReturn($response->updateAttributeOptionResult);

        $this->assertInstanceOf(
            PoolAttributeInterface::class,
            $this->subject->updateAttributeOption($id, $attributeId, $optionId, $label)
        );
    }
}
