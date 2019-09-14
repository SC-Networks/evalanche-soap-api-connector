<?php

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkInterface;

/**
 * Class SmartLinkClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Smartlink
 */
class SmartLinkClientTest extends TestCase
{

    /**
     * @var SmartLinkClient
     */
    private $subject;

    /**
     * @var \Scn\EvalancheSoapApiConnector\EvalancheSoapClient|MockObject
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
        $this->soapClient = $this->getWsdlMock(['createLink', 'getTrackingUrls']);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new SmartLinkClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateLinkCanReturnString()
    {
        $id = 45;
        $title = 'some title';
        $url = 'some url';

        $result_string = 'some string';

        $result = new \stdClass();
        $result->createLinkResult = $result_string;

        $this->soapClient->expects($this->once())->method('createLink')->with([
            'smartlink_id' => $id,
            'link_name' => $title,
            'link_url' => $url
        ])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getString')->with(
            $result,
            'createLinkResult'
        )->willReturn($result_string);

        $this->assertSame($result_string, $this->subject->createLink($id, $title, $url));
    }

    public function testGetTrackingUrlsCanReturnArrayOfSmartLink()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(SmartLinkInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(SmartLinkInterface::class)->getMock();

        $response = new \stdClass();
        $response->getTrackingUrlsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createSmartLinkConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getTrackingUrls')->with(['smartlink_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getTrackingUrlsResult',
            $config
        )->willReturn([$object, $otherObject]);

        $this->assertContainsOnlyInstancesOf(
            SmartLinkInterface::class,
            $this->subject->getTrackingUrls($id)
        );
    }
}
