<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Milestone;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use stdClass;

/**
 * Class MilestoneClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Milestone
 */
class MilestoneClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var MilestoneClient
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
            'rename',
            'isAlive'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new MilestoneClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateCanReturnInstanceOfResourceInformation()
    {
        $title = 'some title';
        $folderId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);
        $this->soapClient->expects($this->once())->method('create')->with([
            'title' => $title,
            'folder_id' => $folderId,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createResult',
            $config
        )->willReturn($response->createResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($title, $folderId)
        );
    }
}
