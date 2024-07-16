<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;

class EvalancheConnectionTest extends TestCase
{
    private EvalancheConnection $subject;

    /**
     * @var EvalancheConfigInterface|MockObject
     */
    private $config;

    /**
     * @var SoapClientFactoryInterface|MockObject
     */
    private $soapClientFactory;

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
    private $extrator;

    public function setUp(): void
    {
        $this->config = $this->getMockBuilder(EvalancheConfigInterface::class)->getMock();
        $this->soapClientFactory = $this->getMockBuilder(SoapClientFactoryInterface::class)->getMock();
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extrator = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new EvalancheConnection(
            $this->config,
            $this->soapClientFactory,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extrator
        );
    }

    public function testCreateAccountClientCanReturnInstanceOfAccountClient()
    {
        self::assertInstanceOf(
            Client\Account\AccountClientInterface::class,
            $this->subject->createAccountClient()
        );
    }

    public function testCreateArticleClientCanReturnInstanceOfArticleClient()
    {
        self::assertInstanceOf(
            Client\Article\ArticleClientInterface::class,
            $this->subject->createArticleClient()
        );
    }

    public function testCreateArticleTemplateClientCanReturnInstanceOfArticleTemplateClient()
    {
        self::assertInstanceOf(
            Client\Article\ArticleTemplateClientInterface::class,
            $this->subject->createArticleTemplateClient()
        );
    }

    public function testCreateArticleTypeClientCanReturnInstanceOfArticleTypeClient()
    {
        self::assertInstanceOf(
            Client\Article\ArticleTypeClientInterface::class,
            $this->subject->createArticleTypeClient()
        );
    }

    public function testCreateFolderClientCanReturnInstanceOfCategoryClient()
    {
        self::assertInstanceOf(
            Client\Folder\FolderClientInterface::class,
            $this->subject->createFolderClient()
        );
    }

    public function testCreateContainerClientCanReturnInstanceOfContainerClient()
    {
        self::assertInstanceOf(
            Client\Container\ContainerClientInterface::class,
            $this->subject->createContainerClient()
        );
    }

    public function testCreateContainerTypeClientCanReturnInstanceOfContainerTypeClient()
    {
        self::assertInstanceOf(
            Client\Container\ContainerTypeClientInterface::class,
            $this->subject->createContainerTypeClient()
        );
    }

    public function testCreateDocumentClientCanReturnInstanceOfDocumentClient()
    {
        self::assertInstanceOf(
            Client\Document\DocumentClientInterface::class,
            $this->subject->createDocumentClient()
        );
    }

    public function testCreateFormClientCanReturnInstanceOfFormClient()
    {
        self::assertInstanceOf(
            Client\Form\FormClientInterface::class,
            $this->subject->createFormClient()
        );
    }

    public function testCreateTargetGroupClientCanReturnInstanceOfTargetGroupClient()
    {
        self::assertInstanceOf(
            Client\TargetGroup\TargetGroupClientInterface::class,
            $this->subject->createTargetGroupClient()
        );
    }

    public function testCreateImageClientCanReturnInstanceOfImageClient()
    {
        self::assertInstanceOf(
            Client\Image\ImageClientInterface::class,
            $this->subject->createImageClient()
        );
    }

    public function testCreateMailingclientCanReturnInstanceOfMailingClient()
    {
        self::assertInstanceOf(
            Client\Mailing\MailingClientInterface::class,
            $this->subject->createMailingClient()
        );
    }

    public function testCreateMailingTemplateClientCanReturnInstanceOfMailingTemplateClient()
    {
        self::assertInstanceOf(
            Client\Mailing\MailingTemplateClientInterface::class,
            $this->subject->createMailingTemplateClient()
        );
    }

    public function testCreateMandatorClientCanReturnInstanceOfMandatorClient()
    {
        self::assertInstanceOf(
            Client\Mandator\MandatorClientInterface::class,
            $this->subject->createMandatorClient()
        );
    }

    public function testCreatePoolClientCanReturnInstanceOfPoolClient()
    {
        self::assertInstanceOf(
            Client\Pool\PoolClientInterface::class,
            $this->subject->createPoolClient()
        );
    }

    public function testCreatePoolDataMinerClientCanReturnInstanceOfPoolDataMinerClient()
    {
        self::assertInstanceOf(
            Client\Pool\PoolDataMinerClientInterface::class,
            $this->subject->createPoolDataMinerClient()
        );
    }

    public function testCreateProfileClientCanReturnInstanceOfProfileClient()
    {
        self::assertInstanceOf(
            Client\Profile\ProfileClientInterface::class,
            $this->subject->createProfileClient()
        );
    }

    public function testCreateReportClientCanReturnInstanceOfReportClient()
    {
        self::assertInstanceOf(
            Client\Report\ReportClientInterface::class,
            $this->subject->createReportClient()
        );
    }

    public function testCreateScoringClientCanReturnInstanceOfScoringClient()
    {
        self::assertInstanceOf(
            Client\Scoring\ScoringClientInterface::class,
            $this->subject->createScoringClient()
        );
    }

    public function testCreateSmartLinkClientCanReturnInstanceOfSmartLinkClient()
    {
        self::assertInstanceOf(
            Client\Smartlink\SmartLinkClientInterface::class,
            $this->subject->createSmartLinkClient()
        );
    }

    public function testCreateUserClientCanReturnInstanceOfUserClient()
    {
        self::assertInstanceOf(
            Client\User\UserClientInterface::class,
            $this->subject->createUserClient()
        );
    }

    public function testCreateWorkflowClientCanReturnInstanceOfWorkflowClient()
    {
        self::assertInstanceOf(
            Client\Workflow\WorkflowClientInterface::class,
            $this->subject->createWorkflowClient()
        );
    }

    public function testCreateCanReturnInstanceOfEvalancheConnection()
    {
        self::assertInstanceOf(
            EvalancheConnectionInterface::class,
            $this->subject::create('some host', 'some user', 'some password')
        );
    }

    public function testCreateBlackListClientCanReturnInstanceOfBlackListClient()
    {
        self::assertInstanceOf(
            Client\Blacklist\BlackListClient::class,
            $this->subject->createBlackListClient()
        );
    }

    public function testCreateWebhookClientCanReturnInstanceOfWebhookClient()
    {
        self::assertInstanceOf(
            Client\Webhook\WebhookClient::class,
            $this->subject->createWebhookClient()
        );
    }

    public function testCreateMilestoneClientCanReturnInstanceOfMileStoneClient()
    {
        self::assertInstanceOf(
            Client\Milestone\MilestoneClient::class,
            $this->subject->createMilestoneClient()
        );
    }

    public function testCreateMarketplaceClientCanReturnInstanceOfMarketplaceClient()
    {
        self::assertInstanceOf(
            Client\Marketplace\MarketplaceClient::class,
            $this->subject->createMarketplaceClient()
        );
    }
    
    public function testCreateCouponListClientReturnsInstance(): void
    {
        self::assertInstanceOf(
            Client\CouponList\CouponListClient::class,
            $this->subject->createCouponListClient()
        );
    }

    public function testCreateLeadpageClientCanReturnInstance(): void
    {
        self::assertInstanceOf(
            Client\LeadPage\LeadpageClient::class,
            $this->subject->createLeadpageClient()
        );
    }
}
