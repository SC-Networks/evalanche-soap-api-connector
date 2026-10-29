<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Webhook;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
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
     * @var EvalancheSoapClient|MockObject
     */
    private $soapClient;

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
        $this->soapClient = $this->getWsdlMock([
            'trigger',
            'getAll',
            'getByModificationDate',
        ]);
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
