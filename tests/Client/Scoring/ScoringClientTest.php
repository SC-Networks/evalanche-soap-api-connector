<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Scoring;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
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
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createStub(ExtractorInterface::class);

        $this->subject = new ScoringClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetListByMandatorIdCanReturnArrayOfScoringInstance()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->getMockBuilder(ScoringGroupDetailInterface::class);
        $otherObject = $this->getMockBuilder(ScoringGroupDetailInterface::class);

        $result = new stdClass();
        $result->getGroupsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createScoringGroupDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getGroups',
                [[
                    'mandator_id' => 5
                ]]
            )
            ->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $result,
            'getGroupsResult',
            $config
        )->willReturn([
            $object,
            $otherObject
        ]);

        $this->assertSame(
            [$object, $otherObject],
            $this->subject->getListByMandatorId(5)
        );
    }
}
