<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\TargetGroup;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetailInterface;
use stdClass;

/**
 * Class TargetGroupClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\TargetGroup
 */
class TargetGroupClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
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
     * @var Stub&ExtractorInterface
     */
    private Stub $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock([
            'getAll',
            'getByModificationDate',
            'createByOption',
            'getInformation',
            'move',
            'copy',
            'delete',
            'rename',
        ]);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createStub(ExtractorInterface::class);

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
        $folderId = 44523;
        $title = 'some title';

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->createByOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('createByOption')->with([
            'pool_id' => $id,
            'attribute_id' => $attributeId,
            'option_id' => $optionId,
            'category_id' => $folderId,
            'name' => $title,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createByOptionResult',
            $config
        )->willReturn($response->createByOptionResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->createByOption($id, $attributeId, $optionId, $folderId, $title)
        );
    }

    public function testGetDetailByIdCanReturnInstanceOfTargetGroupDetailInterface()
    {
        $id = 234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(TargetGroupDetailInterface::class);

        $response = new stdClass();
        $response->createByOptionResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createTargetGroupDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getInformation')->with([
            'targetgroup_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getInformationResult',
            $config
        )->willReturn($response->createByOptionResult);


        self::assertInstanceOf(
            TargetGroupDetailInterface::class,
            $this->subject->getDetailById($id)
        );
    }
}
