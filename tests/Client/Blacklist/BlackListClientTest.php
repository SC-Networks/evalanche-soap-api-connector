<?php

namespace Scn\EvalancheSoapApiConnector\Client\Blacklist;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListInterface;

/**
 * Class BlackListClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Blacklist
 */
class BlackListClientTest extends TestCase
{
    /**
     * @var BlackListClient
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
            'get',
            'add',
            'remove'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new BlackListClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetWsdlUriCanReturnString()
    {
        $this->assertSame('api/soap/v1/blacklist/wsdl', $this->subject->getWsdlUri());
    }

    public function testAdd()
    {
        $this->assertNull($this->subject->add(1, 'some@email.de', 'some description'));
    }

    public function testRemove()
    {
        $this->assertNull($this->subject->remove(1, 'some@email.de'));
    }

    public function testGetCanReturnInstanceOfBlackList()
    {
        $mandatorId = 523;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(BlackListInterface::class)->getMock();

        $response = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createBlackListConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('get')->with([
            'CustomerId' => $mandatorId
            ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjectDirectly')->with(
            $response,
            $config
        )->willReturn($response);

        $this->assertInstanceOf(
            BlackListInterface::class,
            $this->subject->get($mandatorId)
        );
    }
}
