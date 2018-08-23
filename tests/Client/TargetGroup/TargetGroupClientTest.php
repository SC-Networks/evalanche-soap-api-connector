<?php

namespace Scn\EvalancheSoapApiConnector\Client\TargetGroup;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetailInterface;

/**
 * Class TargetGroupClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\TargetGroup
 */
class TargetGroupClientTest extends TestCase
{
    /**
     * @var TargetGroupClient
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
            'createByOption',
            'getInformation',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new TargetGroupClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateByOptionCanReturnInstanceOfResourceInformation()
    {
        $id = 123;
        $attributeId = 556;
        $optionId = 7645;
        $categoryId = 44523;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->createByOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('createByOption')->with([
            'pool_id' => $id,
            'attribute_id' => $attributeId,
            'option_id' => $optionId,
            'category_id' => $categoryId,
            'name' => $title,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'createByOptionResult',
            $config)->willReturn($response->createByOptionResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->createByOption($id, $attributeId, $optionId, $categoryId, $title)
        );
    }

    public function testGetDetailByIdCanReturnInstanceOfTargetGroupDetailInterface()
    {
        $id = 234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(TargetGroupDetailInterface::class)->getMock();

        $response = new \stdClass();
        $response->createByOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createTargetGroupDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getInformation')->with([
            'targetgroup_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getInformationResult',
            $config)->willReturn($response->createByOptionResult);


        $this->assertInstanceOf(
            TargetGroupDetailInterface::class,
            $this->subject->getDetailById($id)
        );
    }
}
