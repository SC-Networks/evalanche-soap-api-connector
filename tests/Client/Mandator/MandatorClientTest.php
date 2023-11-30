<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Mandator;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;
use stdClass;

/**
 * Class MandatorClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mandator
 */
class MandatorClientTest extends TestCase
{
    /**
     * @var MandatorClient
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
        $this->soapClient = $this->getWsdlMock(['getById', 'getList']);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new MandatorClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetByIdCanReturnMandatorInterface()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MandatorInterface::class)->getMock();

        $result = new stdClass();
        $result->getByIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMandatorConfig')
            ->willReturn($config);

        $this->soapClient
            ->expects($this->once())
            ->method('getById')
            ->with(['mandator_id' => 5])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'getByIdResult', $config)
            ->willReturn($object);

        self::assertSame(
            $object,
            $this->subject->getById(5)
        );
    }

    public function testGetListCanReturnArrayOfMandatorInterface()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MandatorInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MandatorInterface::class)->getMock();

        $list = new stdClass();
        $list->item = [
            $object,
            $otherObject
        ];

        $result = new stdClass();
        $result->getListResult = $list;

        $this->hydratorConfigFactory->expects($this->once())->method('createMandatorConfig')
            ->willReturn($config);

        $this->soapClient
            ->expects($this->once())
            ->method('getList')
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObjects')
            ->with($result, 'getListResult', $config)
            ->willReturn([$object, $otherObject]);

        $this->assertContainsOnlyInstancesOf(
            MandatorInterface::class,
            $this->subject->getList()
        );
    }
}
