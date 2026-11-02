<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkInterface;
use stdClass;

/**
 * Class SmartLinkClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Smartlink
 */
#[AllowMockObjectsWithoutExpectations]
class SmartLinkClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    private SmartLinkClient $subject;

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
     * @var MockObject&ExtractorInterface
     */
    private MockObject $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
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

    public function testCreateLinkCanReturnString(): void
    {
        $id = 45;
        $title = 'some title';
        $url = 'some url';

        $result_string = 'some string';

        $result = new stdClass();
        $result->createLinkResult = $result_string;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'createLink',
                [[
                    'smartlink_id' => $id,
                    'link_name' => $title,
                    'link_url' => $url
                ]]
            )
            ->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getString')->with(
            $result,
            'createLinkResult'
        )->willReturn($result_string);

        self::assertSame($result_string, $this->subject->createLink($id, $title, $url));
    }

    public function testGetTrackingUrlsCanReturnArrayOfSmartLink(): void
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
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getTrackingUrls',
                [[
                    'smartlink_id' => $id
                ]]
            )
            ->willReturn($response);
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

    public function testGetLinkConfigurations(): void
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
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getLinkConfigurations',
                [[
                    'smartlink_link_id' => $link_id
                ]]
            )
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

    public function testSetLinkConfigurations(): void
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

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'setLinkConfigurations',
                [[
                    'smartlink_link_id' => $link_id,
                    'items' => $extractedData
                ]]
            )
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

    public function testCreateLinkConfigurations(): void
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

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'createLinkConfigurations',
                [[
                    'smartlink_link_id' => $link_id,
                    'items' => $extractedData
                ]]
            )
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
