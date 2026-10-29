<?php

namespace Scn\EvalancheSoapApiConnector;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Account\AccountClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Account\AccountClient;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleClient;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleTemplateClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleTemplateClient;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleTypeClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Article\ArticleTypeClient;
use Scn\EvalancheSoapApiConnector\Client\Folder\FolderClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Folder\FolderClient;
use Scn\EvalancheSoapApiConnector\Client\Container\ContainerClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Container\ContainerClient;
use Scn\EvalancheSoapApiConnector\Client\Container\ContainerTypeClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Container\ContainerTypeClient;
use Scn\EvalancheSoapApiConnector\Client\Document\DocumentClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Document\DocumentClient;
use Scn\EvalancheSoapApiConnector\Client\Form\FormClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Form\FormClient;
use Scn\EvalancheSoapApiConnector\Client\TargetGroup\TargetGroupClientInterface;
use Scn\EvalancheSoapApiConnector\Client\TargetGroup\TargetGroupClient;
use Scn\EvalancheSoapApiConnector\Client\Image\ImageClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Image\ImageClient;
use Scn\EvalancheSoapApiConnector\Client\LeadPage\LeadpageClientInterface;
use Scn\EvalancheSoapApiConnector\Client\LeadPage\LeadpageClient;
use Scn\EvalancheSoapApiConnector\Client\Mailing\MailingClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Mailing\MailingClient;
use Scn\EvalancheSoapApiConnector\Client\Mailing\MailingTemplateClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Mailing\MailingTemplateClient;
use Scn\EvalancheSoapApiConnector\Client\Mandator\MandatorClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Mandator\MandatorClient;
use Scn\EvalancheSoapApiConnector\Client\Pool\PoolClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Pool\PoolClient;
use Scn\EvalancheSoapApiConnector\Client\Pool\PoolDataMinerClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Pool\PoolDataMinerClient;
use Scn\EvalancheSoapApiConnector\Client\Profile\ProfileClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Profile\ProfileClient;
use Scn\EvalancheSoapApiConnector\Client\Report\ReportClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Report\ReportClient;
use Scn\EvalancheSoapApiConnector\Client\Scoring\ScoringClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Scoring\ScoringClient;
use Scn\EvalancheSoapApiConnector\Client\Smartlink\SmartLinkClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Smartlink\SmartLinkClient;
use Scn\EvalancheSoapApiConnector\Client\User\UserClientInterface;
use Scn\EvalancheSoapApiConnector\Client\User\UserClient;
use Scn\EvalancheSoapApiConnector\Client\Workflow\WorkflowClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Workflow\WorkflowClient;
use Scn\EvalancheSoapApiConnector\Client\Blacklist\BlackListClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Blacklist\BlackListClient;
use Scn\EvalancheSoapApiConnector\Client\Webhook\WebhookClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Webhook\WebhookClient;
use Scn\EvalancheSoapApiConnector\Client\Milestone\MilestoneClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Milestone\MilestoneClient;
use Scn\EvalancheSoapApiConnector\Client\Marketplace\MarketplaceClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Marketplace\MarketplaceClient;
use Scn\EvalancheSoapApiConnector\Client\CouponList\CouponListClientInterface;
use Scn\EvalancheSoapApiConnector\Client\CouponList\CouponListClient;
use Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate\LeadpageTemplateClientInterface;
use Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate\LeadpageTemplateClient;
use Scn\EvalancheSoapApiConnector\Extractor\Extractor;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactory;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapper;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\Hydrator\Hydrator;

final readonly class EvalancheConnection implements EvalancheConnectionInterface
{
    public function __construct(private EvalancheConfigInterface $config, private SoapClientFactoryInterface $soapClientFactory, private ResponseMapperInterface $responseMapper, private HydratorConfigFactoryInterface $hydratorConfigFactory, private ExtractorInterface $extractor)
    {
    }

    public static function create(
        string $hostname,
        string $username,
        string $password,
        bool $debugMode = false,
        array $soapClientOptions = []
    ): EvalancheConnectionInterface {
        return new EvalancheConnection(
            new EvalancheConfig(
                $hostname,
                $username,
                $password,
                $debugMode,
                $soapClientOptions
            ),
            new SoapClientFactory(),
            new ResponseMapper(
                new Hydrator()
            ),
            new HydratorConfigFactory(),
            new Extractor(
                new Hydrator()
            )
        );
    }

    private function createClient(string $clientClass): ClientInterface
    {
        /* @var $clientClass Client\ClientInterface */
        $soapClient = $this->soapClientFactory->create($this->config, $clientClass::getWsdlUri());

        return new $clientClass($soapClient, $this->responseMapper, $this->hydratorConfigFactory, $this->extractor);
    }

    public function createAccountClient(): AccountClientInterface
    {
        return $this->createClient(AccountClient::class);
    }

    public function createArticleClient(): ArticleClientInterface
    {
        return $this->createClient(ArticleClient::class);
    }

    public function createArticleTemplateClient(): ArticleTemplateClientInterface
    {
        return $this->createClient(ArticleTemplateClient::class);
    }

    public function createArticleTypeClient(): ArticleTypeClientInterface
    {
        return $this->createClient(ArticleTypeClient::class);
    }

    public function createFolderClient(): FolderClientInterface
    {
        return $this->createClient(FolderClient::class);
    }

    public function createContainerClient(): ContainerClientInterface
    {
        return $this->createClient(ContainerClient::class);
    }

    public function createContainerTypeClient(): ContainerTypeClientInterface
    {
        return $this->createClient(ContainerTypeClient::class);
    }

    public function createDocumentClient(): DocumentClientInterface
    {
        return $this->createClient(DocumentClient::class);
    }

    public function createFormClient(): FormClientInterface
    {
        return $this->createClient(FormClient::class);
    }

    public function createTargetGroupClient(): TargetGroupClientInterface
    {
        return $this->createClient(TargetGroupClient::class);
    }

    public function createImageClient(): ImageClientInterface
    {
        return $this->createClient(ImageClient::class);
    }

    public function createLeadpageClient(): LeadpageClientInterface
    {
        return $this->createClient(LeadpageClient::class);
    }

    public function createMailingClient(): MailingClientInterface
    {
        return $this->createClient(MailingClient::class);
    }

    public function createMailingTemplateClient(): MailingTemplateClientInterface
    {
        return $this->createClient(MailingTemplateClient::class);
    }

    public function createMandatorClient(): MandatorClientInterface
    {
        return $this->createClient(MandatorClient::class);
    }

    public function createPoolClient(): PoolClientInterface
    {
        return $this->createClient(PoolClient::class);
    }

    public function createPoolDataMinerClient(): PoolDataMinerClientInterface
    {
        return $this->createClient(PoolDataMinerClient::class);
    }

    public function createProfileClient(): ProfileClientInterface
    {
        return $this->createClient(ProfileClient::class);
    }

    public function createReportClient(): ReportClientInterface
    {
        return $this->createClient(ReportClient::class);
    }

    public function createScoringClient(): ScoringClientInterface
    {
        return $this->createClient(ScoringClient::class);
    }

    public function createSmartLinkClient(): SmartLinkClientInterface
    {
        return $this->createClient(SmartLinkClient::class);
    }

    public function createUserClient(): UserClientInterface
    {
        return $this->createClient(UserClient::class);
    }

    public function createWorkflowClient(): WorkflowClientInterface
    {
        return $this->createClient(WorkflowClient::class);
    }

    public function createBlackListClient(): BlackListClientInterface
    {
        return $this->createClient(BlackListClient::class);
    }

    public function createWebhookClient(): WebhookClientInterface
    {
        return $this->createClient(WebhookClient::class);
    }

    public function createMilestoneClient(): MilestoneClientInterface
    {
        return $this->createClient(MilestoneClient::class);
    }

    public function createMarketplaceClient(): MarketplaceClientInterface
    {
        return $this->createClient(MarketplaceClient::class);
    }
    
    public function createCouponListClient(): CouponListClientInterface
    {
        return $this->createClient(CouponListClient::class);
    }

    public function createLeadpageTemplateClient(): LeadpageTemplateClientInterface
    {
        return $this->createClient(LeadpageTemplateClient::class);
    }
}
