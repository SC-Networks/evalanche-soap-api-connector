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
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use stdClass;

/**
 * Class ContainerTypeClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
class ContainerTypeClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var ContainerTypeClient
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
            'addAttribute',
            'addAttributeGroup',
            'changeAttributeType',
            'createAttributeOption',
            'getAttributeGroups',
            'getAttributeOptions',
            'getAttributes',
            'removeAttribute',
            'removeAttributeGroup',
            'removeAttributeOption',
            'updateAttribute',
            'rename',
            'move',
            'copy',
            'delete',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ContainerTypeClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testAddAttributeCanReturnIsntanceOfContainerAttributeInterface()
    {
        $id = 23;
        $title = 'some title';
        $label = 'some label';
        $typeId = 55;
        $groupId = 767;


        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();

        $response = new stdClass();
        $response->addAttributeResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addAttribute')->with([
            'resource_id' => $id,
            'name' => $title,
            'label' => $label,
            'type_id' => $typeId,
            'group_id' => $groupId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'addAttributeResult',
            $config
        )->willReturn($response->addAttributeResult);

        self::assertInstanceOf(
            ContainerAttributeInterface::class,
            $this->subject->addAttribute($id, $title, $label, $typeId, $groupId)
        );
    }

    public function testAddAttributeGroupCanReturnInstanceOfContainerAttributeInterface()
    {
        $id = 23;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeGroupInterface::class)->getMock();

        $response = new stdClass();
        $response->addAttributeGroupResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeGroupConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addAttributeGroup')->with([
            'resource_id' => $id,
            'name' => $title
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'addAttributeGroupResult',
            $config
        )->willReturn($response->addAttributeGroupResult);

        self::assertInstanceOf(
            ContainerAttributeGroupInterface::class,
            $this->subject->addAttributeGroup($id, $title)
        );
    }

    public function testUpdateAttributeTypeCanReturnBoolean()
    {
        $id = 23;
        $attributeId = 55;
        $typeId = 88;

        $response = new stdClass();
        $response->changeAttributeTypeResult = false;

        $this->soapClient->expects($this->once())->method('changeAttributeType')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'type_id' => $typeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'changeAttributeTypeResult'
        )->willReturn($response->changeAttributeTypeResult);


        $this->assertFalse($this->subject->updateAttributeType($id, $attributeId, $typeId));
    }

    public function testAddAttributeOptionCanReturnInstanceOfContainerAttributeOptionInterface()
    {
        $id = 23;
        $attributeId = 234;
        $label = 'some label';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();

        $response = new stdClass();
        $response->createAttributeOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeOptionConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('createAttributeOption')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'label' => $label
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createAttributeOptionResult',
            $config
        )->willReturn($response->createAttributeOptionResult);

        self::assertInstanceOf(
            ContainerAttributeOptionInterface::class,
            $this->subject->addAttributeOption($id, $attributeId, $label)
        );
    }

    public function testGetAttributeGroupsByResourceIdCanReturnArrayOfContainerAttributeGroup()
    {
        $id = 213;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();

        $response = new stdClass();
        $response->getAttributeGroupsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeGroupConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributeGroups')->with([
            'resource_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getAttributeGroupsResult',
            $config
        )->willReturn($response->getAttributeGroupsResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeOptionInterface::class,
            $this->subject->getAttributeGroupsByResourceId($id)
        );
    }

    public function testGetAttributeOptionsByResourceIdAndAttributeIdCanReturnArrayOfContainerAttributeOption()
    {
        $id = 8;
        $attributeId = 9;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();

        $response = new stdClass();
        $response->getAttributeOptionsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeOptionConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributeOptions')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getAttributeOptionsResult',
            $config
        )->willReturn($response->getAttributeOptionsResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeOptionInterface::class,
            $this->subject->getAttributeOptionsByResourceIdAndAttributeId($id, $attributeId)
        );
    }

    public function testGetAttributesByResourceIdCanReturnArrayOfContainerAttribute()
    {
        $id = 12;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();

        $response = new stdClass();
        $response->getAttributesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributes')->with([
            'resource_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getAttributesResult',
            $config
        )->willReturn($response->getAttributesResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeInterface::class,
            $this->subject->getAttributesByResourceId($id)
        );
    }

    public function testRemoveAttributeCanReturnBoolean()
    {
        $id = 123;
        $attributeId = 543;

        $response = new stdClass();
        $response->removeAttributeResult = true;

        $this->soapClient->expects($this->once())->method('removeAttribute')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'removeAttributeResult'
        )->willReturn($response->removeAttributeResult);

        $this->assertTrue($this->subject->removeAttribute($id, $attributeId));
    }

    public function testRemoveAttributeGroupCanReturnBoolean()
    {
        $id = 123;
        $attributeGroupId = 543;

        $response = new stdClass();
        $response->removeAttributeGroupResult = true;

        $this->soapClient->expects($this->once())->method('removeAttributeGroup')->with([
            'resource_id' => $id,
            'attribute_group_id' => $attributeGroupId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'removeAttributeGroupResult'
        )->willReturn($response->removeAttributeGroupResult);

        $this->assertTrue($this->subject->removeAttributeGroup($id, $attributeGroupId));
    }

    public function testRemoveAttributeOptionCanReturnBoolean()
    {
        $id = 123;
        $attributeId = 543;
        $optionId = 234;

        $response = new stdClass();
        $response->removeAttributeResult = true;

        $this->soapClient->expects($this->once())->method('removeAttributeOption')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'option_id' => $optionId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'removeAttributeOptionResult'
        )->willReturn($response->removeAttributeResult);

        $this->assertTrue($this->subject->removeAttributeOption($id, $attributeId, $optionId));
    }

    public function testUpdateAttributeCanReturnInstanceOfContainerAttribute()
    {
        $id = 34;
        $attributeId = 324;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();

        $extractedData = [
            'some key' => 'some value',
            'some other key' => 'some other value'
        ];

        $response = new stdClass();
        $response->updateAttributeResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with(
            $config,
            $hashMap
        )->willReturn($extractedData);
        $this->soapClient->expects($this->once())->method('updateAttribute')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'data' => $extractedData
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->willReturn($response->updateAttributeResult);

        self::assertInstanceOf(
            ContainerAttributeInterface::class,
            $this->subject->updateAttribute($id, $attributeId, $hashMap)
        );
    }
}
