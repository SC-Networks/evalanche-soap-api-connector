<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Scoring;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetailInterface;
use stdClass;

/**
 * Class ScoringClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Scoring
 */
class ScoringClientTest extends TestCase
{
    /**
     * @var ScoringClient
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
        $this->soapClient = $this->getWsdlMock(['getGroups']);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ScoringClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testgetListByMandatorIdCanReturnArrayOfScoringInstance()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ScoringGroupDetailInterface::class);
        $otherObject = $this->getMockBuilder(ScoringGroupDetailInterface::class);

        $result = new stdClass();
        $result->getGroupsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createScoringGroupDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getGroups')->with(['mandator_id' => 5])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $result,
            'getGroupsResult',
            $config
        )->willReturn([
            $object,
            $otherObject
        ]);

        $this->containsOnlyInstancesOf(
            ScoringGroupDetailInterface::class,
            $this->subject->getListByMandatorId(5)
        );
    }
}
