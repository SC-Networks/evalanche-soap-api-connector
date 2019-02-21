<?php

namespace Scn\EvalancheSoapApiConnector\Client\Webhook;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;

/**
 * Class WebhookTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Webhook
 */
class WebhookClientTest extends TestCase
{
    /**
     * @var WebhookClient
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
        $this->soapClient = $this->getWsdlMock(['trigger']);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new WebhookClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testTriggerCanTrigger()
    {
        $hookId = 234;
        $profileId = 423;

        $this->soapClient
            ->expects($this->once())
            ->method('trigger')
            ->with(['webhookId' => $hookId, 'profileId' => $profileId])
            ->willReturn(null);

        $this->assertNull($this->subject->trigger($hookId, $profileId));
    }

}
