<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Blacklist;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListInterface;

/**
 * Class BlackListClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Blacklist
 */
#[AllowMockObjectsWithoutExpectations]
class BlackListClientTest extends TestCase
{
    private BlackListClient $subject;

    /**
     * @var MockObject&EvalancheSoapClient
     */
    private MockObject $soapClient;

    /**
     * @var MockObject&ResponseMapperInterface
     */
    private MockObject $responseMapper;

    /**
     * @var MockObject&HydratorConfigFactoryInterface
     */
    private MockObject $hydratorConfigFactory;

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

        $this->subject = new BlackListClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetWsdlUriCanReturnString(): void
    {
        self::assertSame('api/soap/v1/blacklist/wsdl', $this->subject->getWsdlUri());
    }

    public function testAdd(): void
    {
        $this->assertNull($this->subject->add(1, 'some@email.de', 'some description'));
    }

    public function testRemove(): void
    {
        $this->assertNull($this->subject->remove(1, 'some@email.de'));
    }

    public function testGetCanReturnInstanceOfBlackList(): void
    {
        $mandatorId = 523;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(BlackListInterface::class);

        $response = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createBlackListConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'get',
                [[
                    'CustomerId' => $mandatorId
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjectDirectly')->with(
            $response,
            $config
        )->willReturn($response);

        self::assertInstanceOf(
            BlackListInterface::class,
            $this->subject->get($mandatorId)
        );
    }
}
