<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\Stub;
use Scn\EvalancheSoapApiConnector\Client\Account\AccountClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleTemplateClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleTypeClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Folder\FolderClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Container\ContainerClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Container\ContainerTypeClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Document\DocumentClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Form\FormClientInterface;
use Scn\EvalancheSoapApiConnector\Client\TargetGroup\TargetGroupClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Image\ImageClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Mailing\MailingClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Mailing\MailingTemplateClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Mandator\MandatorClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Pool\PoolClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Pool\PoolDataMinerClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Profile\ProfileClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Report\ReportClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Scoring\ScoringClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Smartlink\SmartLinkClientInterface;
use Scn\EvalancheSoapApiConnector\Client\User\UserClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Workflow\WorkflowClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Blacklist\BlackListClient;
use Scn\EvalancheSoapApiConnector\Client\Webhook\WebhookClient;
use Scn\EvalancheSoapApiConnector\Client\Milestone\MilestoneClient;
use Scn\EvalancheSoapApiConnector\Client\Marketplace\MarketplaceClient;
use Scn\EvalancheSoapApiConnector\Client\CouponList\CouponListClient;
use Scn\EvalancheSoapApiConnector\Client\LeadPage\LeadpageClient;
use Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate\LeadpageTemplateClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;

class EvalancheConnectionTest extends TestCase
{
    private EvalancheConnection $subject;

    /**
     * @var Stub&EvalancheConfigInterface
     */
    private Stub $config;

    /**
     * @var Stub&SoapClientFactoryInterface
     */
    private Stub $soapClientFactory;

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
    private Stub $extrator;

    public function setUp(): void
    {
        $this->config = $this->createStub(EvalancheConfigInterface::class);
        $this->soapClientFactory = $this->createStub(SoapClientFactoryInterface::class);
        $this->responseMapper = $this->createStub(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createStub(HydratorConfigFactoryInterface::class);
        $this->extrator = $this->createStub(ExtractorInterface::class);

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
            AccountClientInterface::class,
            $this->subject->createAccountClient()
        );
    }

    public function testCreateArticleClientCanReturnInstanceOfArticleClient()
    {
        self::assertInstanceOf(
            ArticleClientInterface::class,
            $this->subject->createArticleClient()
        );
    }

    public function testCreateArticleTemplateClientCanReturnInstanceOfArticleTemplateClient()
    {
        self::assertInstanceOf(
            ArticleTemplateClientInterface::class,
            $this->subject->createArticleTemplateClient()
        );
    }

    public function testCreateArticleTypeClientCanReturnInstanceOfArticleTypeClient()
    {
        self::assertInstanceOf(
            ArticleTypeClientInterface::class,
            $this->subject->createArticleTypeClient()
        );
    }

    public function testCreateFolderClientCanReturnInstanceOfCategoryClient()
    {
        self::assertInstanceOf(
            FolderClientInterface::class,
            $this->subject->createFolderClient()
        );
    }

    public function testCreateContainerClientCanReturnInstanceOfContainerClient()
    {
        self::assertInstanceOf(
            ContainerClientInterface::class,
            $this->subject->createContainerClient()
        );
    }

    public function testCreateContainerTypeClientCanReturnInstanceOfContainerTypeClient()
    {
        self::assertInstanceOf(
            ContainerTypeClientInterface::class,
            $this->subject->createContainerTypeClient()
        );
    }

    public function testCreateDocumentClientCanReturnInstanceOfDocumentClient()
    {
        self::assertInstanceOf(
            DocumentClientInterface::class,
            $this->subject->createDocumentClient()
        );
    }

    public function testCreateFormClientCanReturnInstanceOfFormClient()
    {
        self::assertInstanceOf(
            FormClientInterface::class,
            $this->subject->createFormClient()
        );
    }

    public function testCreateTargetGroupClientCanReturnInstanceOfTargetGroupClient()
    {
        self::assertInstanceOf(
            TargetGroupClientInterface::class,
            $this->subject->createTargetGroupClient()
        );
    }

    public function testCreateImageClientCanReturnInstanceOfImageClient()
    {
        self::assertInstanceOf(
            ImageClientInterface::class,
            $this->subject->createImageClient()
        );
    }

    public function testCreateMailingclientCanReturnInstanceOfMailingClient()
    {
        self::assertInstanceOf(
            MailingClientInterface::class,
            $this->subject->createMailingClient()
        );
    }

    public function testCreateMailingTemplateClientCanReturnInstanceOfMailingTemplateClient()
    {
        self::assertInstanceOf(
            MailingTemplateClientInterface::class,
            $this->subject->createMailingTemplateClient()
        );
    }

    public function testCreateMandatorClientCanReturnInstanceOfMandatorClient()
    {
        self::assertInstanceOf(
            MandatorClientInterface::class,
            $this->subject->createMandatorClient()
        );
    }

    public function testCreatePoolClientCanReturnInstanceOfPoolClient()
    {
        self::assertInstanceOf(
            PoolClientInterface::class,
            $this->subject->createPoolClient()
        );
    }

    public function testCreatePoolDataMinerClientCanReturnInstanceOfPoolDataMinerClient()
    {
        self::assertInstanceOf(
            PoolDataMinerClientInterface::class,
            $this->subject->createPoolDataMinerClient()
        );
    }

    public function testCreateProfileClientCanReturnInstanceOfProfileClient()
    {
        self::assertInstanceOf(
            ProfileClientInterface::class,
            $this->subject->createProfileClient()
        );
    }

    public function testCreateReportClientCanReturnInstanceOfReportClient()
    {
        self::assertInstanceOf(
            ReportClientInterface::class,
            $this->subject->createReportClient()
        );
    }

    public function testCreateScoringClientCanReturnInstanceOfScoringClient()
    {
        self::assertInstanceOf(
            ScoringClientInterface::class,
            $this->subject->createScoringClient()
        );
    }

    public function testCreateSmartLinkClientCanReturnInstanceOfSmartLinkClient()
    {
        self::assertInstanceOf(
            SmartLinkClientInterface::class,
            $this->subject->createSmartLinkClient()
        );
    }

    public function testCreateUserClientCanReturnInstanceOfUserClient()
    {
        self::assertInstanceOf(
            UserClientInterface::class,
            $this->subject->createUserClient()
        );
    }

    public function testCreateWorkflowClientCanReturnInstanceOfWorkflowClient()
    {
        self::assertInstanceOf(
            WorkflowClientInterface::class,
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
            BlackListClient::class,
            $this->subject->createBlackListClient()
        );
    }

    public function testCreateWebhookClientCanReturnInstanceOfWebhookClient()
    {
        self::assertInstanceOf(
            WebhookClient::class,
            $this->subject->createWebhookClient()
        );
    }

    public function testCreateMilestoneClientCanReturnInstanceOfMileStoneClient()
    {
        self::assertInstanceOf(
            MilestoneClient::class,
            $this->subject->createMilestoneClient()
        );
    }

    public function testCreateMarketplaceClientCanReturnInstanceOfMarketplaceClient()
    {
        self::assertInstanceOf(
            MarketplaceClient::class,
            $this->subject->createMarketplaceClient()
        );
    }
    
    public function testCreateCouponListClientReturnsInstance(): void
    {
        self::assertInstanceOf(
            CouponListClient::class,
            $this->subject->createCouponListClient()
        );
    }

    public function testCreateLeadpageClientCanReturnInstance(): void
    {
        self::assertInstanceOf(
            LeadpageClient::class,
            $this->subject->createLeadpageClient()
        );
    }

    public function testCreateLeadpageTemplateClientCanReturnInstance(): void
    {
        self::assertInstanceOf(
            LeadpageTemplateClient::class,
            $this->subject->createLeadpageTemplateClient()
        );
    }
}
