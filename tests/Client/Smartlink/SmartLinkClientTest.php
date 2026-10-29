<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkInterface;
use stdClass;

/**
 * Class SmartLinkClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Smartlink
 */
class SmartLinkClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var SmartLinkClient
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
            'getAll',
            'getByModificationDate',
            'createLink',
            'getTrackingUrls',
            'getLinkConfigurations',
            'setLinkConfigurations',
            'createLinkConfigurations',
            'copy',
            'rename',
            'move',
            'delete',
        ]);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

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

        $result = new stdClass();
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

        self::assertSame($result_string, $this->subject->createLink($id, $title, $url));
    }

    public function testGetTrackingUrlsCanReturnArrayOfSmartLink()
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(SmartLinkInterface::class);
        $otherObject = $this->createStub(SmartLinkInterface::class);

        $response = new stdClass();
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

    public function testGetLinkConfigurations()
    {
        $link_id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(SmartLinkConfigurationInterface::class);
        $otherObject = $this->createStub(SmartLinkConfigurationInterface::class);

        $response = new stdClass();
        $response->getLinkConfigurationsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createSmartLinkConfigurationConfig')
            ->willReturn($config);
        $this->soapClient
            ->expects($this->once())
            ->method('getLinkConfigurations')
            ->with(['smartlink_link_id' => $link_id])
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'getLinkConfigurationsResult',
                $config
            )
            ->willReturn([$object, $otherObject]);

        $this->assertContainsOnlyInstancesOf(
            SmartLinkConfigurationInterface::class,
            $this->subject->getLinkConfigurations($link_id)
        );
    }

    public function testSetLinkConfigurations()
    {
        $link_id = 1234;
        $configurations = [
            $this->createStub(SmartLinkConfigurationInterface::class),
            $this->createStub(SmartLinkConfigurationInterface::class)
        ];

        $config = $this->createStub(HydratorConfigInterface::class);

        $response = new stdClass();
        $result = true;
        $response->setLinkConfigurationsResult = $result;

        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $this->extractor->expects($this->once())
            ->method('extractArray')
            ->with(
                $config,
                $configurations
            )
            ->willReturn($extractedData);

        $this->hydratorConfigFactory->expects($this->exactly(1))
            ->method('createSmartLinkConfigurationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('setLinkConfigurations')
            ->with([
                'smartlink_link_id' => $link_id,
                'items' => $extractedData
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'setLinkConfigurationsResult'
            )
            ->willReturn($response->setLinkConfigurationsResult);

        self::assertSame(
            $result,
            $this->subject->setLinkConfigurations($link_id, $configurations)
        );
    }

    public function testCreateLinkConfigurations()
    {
        $link_id = 1234;
        $configurations = [
            $this->createStub(SmartLinkConfigurationInterface::class),
            $this->createStub(SmartLinkConfigurationInterface::class)
        ];

        $config = $this->createStub(HydratorConfigInterface::class);

        $response = new stdClass();
        $result = true;
        $response->setLinkConfigurationsResult = $result;

        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $this->extractor->expects($this->once())
            ->method('extractArray')
            ->with(
                $config,
                $configurations
            )
            ->willReturn($extractedData);

        $this->hydratorConfigFactory->expects($this->exactly(1))
            ->method('createSmartLinkConfigurationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('createLinkConfigurations')
            ->with([
                'smartlink_link_id' => $link_id,
                'items' => $extractedData
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'createLinkConfigurationsResult'
            )
            ->willReturn($response->setLinkConfigurationsResult);

        self::assertSame(
            $result,
            $this->subject->createLinkConfigurations($link_id, $configurations)
        );
    }
}
