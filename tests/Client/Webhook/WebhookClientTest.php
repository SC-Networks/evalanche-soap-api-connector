<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Webhook;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class WebhookTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Webhook
 */
#[AllowMockObjectsWithoutExpectations]
class WebhookClientTest extends TestCase
{
    private WebhookClient $subject;

    /**
     * @var MockObject&EvalancheSoapClient
     */
    private MockObject $soapClient;

    /**
     * @var Stub&ResponseMapperInterface
     */
    private Stub $responseMapper;

    /**
     * @var Stub&HydratorConfigFactoryInterface
     */
    private Stub $hydratorConfigFactory;

    /**
     * @var Stub&ExtractorInterface
     */
    private Stub $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createStub(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createStub(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createStub(ExtractorInterface::class);

        $this->subject = new WebhookClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testTriggerCanTrigger(): void
    {
        $hookId = 234;
        $profileId = 423;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'trigger',
                [[
                    'webhookId' => $hookId,
                    'profileId' => $profileId
                ]]
            )
            ->willReturn(null);

        $this->assertNull($this->subject->trigger($hookId, $profileId));
    }
}
