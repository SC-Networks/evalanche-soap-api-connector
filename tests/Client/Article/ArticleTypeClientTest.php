<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeRoleTypeInterface;

/**
 * Class ArticleTypeClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
class ArticleTypeClientTest extends TestCase
{
    /**
     * @var ArticleTypeClient
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
            'assignRoleToAttribute',
            'changeAttributeType',
            'createAttributeOption',
            'getApplicableRoleTypes',
            'getAssignedRoleTypes',
            'getAttributeGroups',
            'getAttributeOptions',
            'getAttributes',
            'removeAttribute',
            'removeAttributeGroup',
            'removeAttributeOption',
            'updateAttribute'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ArticleTypeClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testAddAttributeCanReturnInstanceOfContainerAttribute()
    {
        $id = 12;
        $title = 'some title';
        $label = 'some label';
        $typeId = 5;
        $groupId = 12;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->addAttributeResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addAttribute')->with([
            'resource_id' => $id,
            'name' => $title,
            'label' => $label,
            'type_id' => $typeId,
            'group_id' => $groupId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'addAttributeResult',
            $config)->willReturn($response->addAttributeResult);

        $this->assertInstanceOf(
            ContainerAttributeInterface::class,
            $this->subject->addAttribute($id, $title, $label, $typeId, $groupId)
        );
    }

    public function testAddAttributeGroupCanReturnInstanceOfCOntainerAttributeGroup()
    {
        $id = 55;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeGroupInterface::class)->getMock();

        $response = new \stdClass();
        $response->addAttributeGroupResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeGroupConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addAttributeGroup')->with([
            'resource_id' => $id,
            'name' => $title
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'addAttributeGroupResult',
            $config)->willReturn($response->addAttributeGroupResult);

        $this->assertInstanceOf(
            ContainerAttributeGroupInterface::class,
            $this->subject->addAttributeGroup($id, $title)
        );
    }

    public function testAssignRoleToAttributeCanReturnBoolean()
    {
        $id = 123;
        $attributeId = 456;
        $roleTypeId = 234;

        $response = new \stdClass();
        $response->assignRoleToAttributeResult = true;

        $this->soapClient->expects($this->once())->method('assignRoleToAttribute')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'role_type_id' => $roleTypeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'assignRoleToAttributeResult')->willReturn($response->assignRoleToAttributeResult);

        $this->assertTrue($this->subject->assignRoleToAttribute($id, $attributeId, $roleTypeId));
    }

    public function testChangeAttributeTypeCanReturnBoolean()
    {
        $id = 45;
        $attributeId = 23;
        $typeId = 234;

        $response = new \stdClass();
        $response->changeAttributeTypeResult = true;

        $this->soapClient->expects($this->once())->method('changeAttributeType')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'type_id' => $typeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'changeAttributeTypeResult')->willReturn($response->changeAttributeTypeResult);

        $this->assertTrue($this->subject->changeAttributeType($id, $attributeId, $typeId));
    }

    public function testCreateAttributeOptionCanReturnInstanceOfContainerAttributeOption()
    {
        $id = 123;
        $attributeId = 55;
        $label = 'some label';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();

        $response = new \stdClass();
        $response->createAttributeOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeOptionConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('createAttributeOption')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'label' => $label
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'createAttributeOptionResult', $config)->willReturn($response->createAttributeOptionResult);

        $this->assertInstanceOf(
            ContainerAttributeOptionInterface::class,
            $this->subject->createAttributeOption($id, $attributeId, $label)
        );
    }

    public function testGetApplicableRoleTypesCanReturnArrayOfContainerAttributeRoleType()
    {
        $id = 9;
        $attributeId = 23;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeRoleTypeInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeRoleTypeInterface::class)->getMock();

        $response = new \stdClass();
        $response->getApplicableRoleTypeResults = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeRoleTypeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getApplicableRoleTypes')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getApplicableRoleTypesResult')->willReturn($response->getApplicableRoleTypeResults);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeRoleTypeInterface::class,
            $this->subject->getApplicableRoleTypes($id, $attributeId)
        );
    }

    public function testGetAssignedRoleTypesCanReturnArrayOfContainerAttributeRoleType()
    {
        $id = 9;
        $attributeId = 23;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeRoleTypeInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeRoleTypeInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAssignedRoleTypesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeRoleTypeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAssignedRoleTypes')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getAssignedRoleTypesResult')->willReturn($response->getAssignedRoleTypesResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeRoleTypeInterface::class,
            $this->subject->getAssignedRoleTypes($id, $attributeId)
        );
    }

    public function testGetAttributeGroupsCanReturnArrayOfContainerAttributeGroup()
    {
        $id = 10;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeGroupInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeGroupInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAttributeGroupsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeGroupConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributeGroups')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getAttributeGroupsResult',
            $config)->willReturn($response->getAttributeGroupsResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeGroupInterface::class,
            $this->subject->getAttributeGroups($id)
        );
    }

    public function testGetAttributeOptionsCanReturnArrayOfContainerAttributeOption()
    {
        $id = 18;
        $attributeId = 99;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeOptionInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAttributeOptionsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeOptionConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributeOptions')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getAttributeOptionsResult',
            $config)->willReturn($response->getAttributeOptionsResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeOptionInterface::class,
            $this->subject->getAttributeOptions($id, $attributeId)
        );
    }

    public function testGetAttributesCanReturnArrayOfContainerAttribute()
    {
        $id = 213;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ContainerAttributeInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAttributesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createContainerAttributeConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAttributes')->with([
            'resource_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getAttributesResult',
            $config)->willReturn($response->getAttributesResult);

        $this->assertContainsOnlyInstancesOf(
            ContainerAttributeInterface::class,
            $this->subject->getAttributes($id)
        );
    }

    public function testRemoveAttributeCanReturnBoolean()
    {
        $id = 234;
        $attributeId = 334;

        $response = new \stdClass();
        $response->removeAttributeResult = true;

        $this->soapClient->expects($this->once())->method('removeAttribute')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'removeAttributeResult')->willReturn($response->removeAttributeResult);

        $this->assertTrue(
            $this->subject->removeAttribute($id, $attributeId)
        );
    }

    public function testRemoveAttributeGroupCanReturnBoolean()
    {
        $id = 234;
        $attributeGroupId = 334;

        $response = new \stdClass();
        $response->removeAttributeGroupResult = true;

        $this->soapClient->expects($this->once())->method('removeAttributeGroup')->with([
            'resource_id' => $id,
            'attribute_group_id' => $attributeGroupId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'removeAttributeGroupResult')->willReturn($response->removeAttributeGroupResult);

        $this->assertTrue(
            $this->subject->removeAttributeGroup($id, $attributeGroupId)
        );
    }

    public function testRemoveAttributeOptionCanReturnBoolean()
    {
        $id = 234;
        $attributeId = 556;
        $optionId = 334;

        $response = new \stdClass();
        $response->removeAttributeOptionResult = true;

        $this->soapClient->expects($this->once())->method('removeAttributeOption')->with([
            'resource_id' => $id,
            'attribute_id' => $attributeId,
            'option_id' => $optionId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'removeAttributeOptionResult')->willReturn($response->removeAttributeOptionResult);

        $this->assertTrue(
            $this->subject->removeAttributeOption($id, $attributeId, $optionId)
        );
    }
}
