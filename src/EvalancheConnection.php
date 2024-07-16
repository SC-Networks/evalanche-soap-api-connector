<?php

namespace Scn\EvalancheSoapApiConnector;

use Scn\EvalancheSoapApiConnector\Extractor\Extractor;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactory;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapper;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\Hydrator\Hydrator;

final class EvalancheConnection implements EvalancheConnectionInterface
{
    private $soapClientFactory;

    private $config;

    private $responseMapper;

    private $hydratorConfigFactory;

    private $extractor;

    public function __construct(
        EvalancheConfigInterface $config,
        SoapClientFactoryInterface $soapClientFactory,
        ResponseMapperInterface $responseMapper,
        HydratorConfigFactoryInterface $hydratorConfigFactory,
        ExtractorInterface $extractor
    ) {
        $this->config = $config;
        $this->soapClientFactory = $soapClientFactory;
        $this->responseMapper = $responseMapper;
        $this->hydratorConfigFactory = $hydratorConfigFactory;
        $this->extractor = $extractor;
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

    private function createClient(string $clientClass): Client\ClientInterface
    {
        /* @var $clientClass Client\ClientInterface */
        $soapClient = $this->soapClientFactory->create($this->config, $clientClass::getWsdlUri());

        return new $clientClass($soapClient, $this->responseMapper, $this->hydratorConfigFactory, $this->extractor);
    }

    public function createAccountClient(): Client\Account\AccountClientInterface
    {
        return $this->createClient(Client\Account\AccountClient::class);
    }

    public function createArticleClient(): Client\Article\ArticleClientInterface
    {
        return $this->createClient(Client\Article\ArticleClient::class);
    }

    public function createArticleTemplateClient(): Client\Article\ArticleTemplateClientInterface
    {
        return $this->createClient(Client\Article\ArticleTemplateClient::class);
    }

    public function createArticleTypeClient(): Client\Article\ArticleTypeClientInterface
    {
        return $this->createClient(Client\Article\ArticleTypeClient::class);
    }

    public function createFolderClient(): Client\Folder\FolderClientInterface
    {
        return $this->createClient(Client\Folder\FolderClient::class);
    }

    public function createContainerClient(): Client\Container\ContainerClientInterface
    {
        return $this->createClient(Client\Container\ContainerClient::class);
    }

    public function createContainerTypeClient(): Client\Container\ContainerTypeClientInterface
    {
        return $this->createClient(Client\Container\ContainerTypeClient::class);
    }

    public function createDocumentClient(): Client\Document\DocumentClientInterface
    {
        return $this->createClient(Client\Document\DocumentClient::class);
    }

    public function createFormClient(): Client\Form\FormClientInterface
    {
        return $this->createClient(Client\Form\FormClient::class);
    }

    public function createTargetGroupClient(): Client\TargetGroup\TargetGroupClientInterface
    {
        return $this->createClient(Client\TargetGroup\TargetGroupClient::class);
    }

    public function createImageClient(): Client\Image\ImageClientInterface
    {
        return $this->createClient(Client\Image\ImageClient::class);
    }

    public function createLeadpageClient(): Client\LeadPage\LeadpageClientInterface
    {
        return $this->createClient(Client\LeadPage\LeadpageClient::class);
    }

    public function createMailingClient(): Client\Mailing\MailingClientInterface
    {
        return $this->createClient(Client\Mailing\MailingClient::class);
    }

    public function createMailingTemplateClient(): Client\Mailing\MailingTemplateClientInterface
    {
        return $this->createClient(Client\Mailing\MailingTemplateClient::class);
    }

    public function createMandatorClient(): Client\Mandator\MandatorClientInterface
    {
        return $this->createClient(Client\Mandator\MandatorClient::class);
    }

    public function createPoolClient(): Client\Pool\PoolClientInterface
    {
        return $this->createClient(Client\Pool\PoolClient::class);
    }

    public function createPoolDataMinerClient(): Client\Pool\PoolDataMinerClientInterface
    {
        return $this->createClient(Client\Pool\PoolDataMinerClient::class);
    }

    public function createProfileClient(): Client\Profile\ProfileClientInterface
    {
        return $this->createClient(Client\Profile\ProfileClient::class);
    }

    public function createReportClient(): Client\Report\ReportClientInterface
    {
        return $this->createClient(Client\Report\ReportClient::class);
    }

    public function createScoringClient(): Client\Scoring\ScoringClientInterface
    {
        return $this->createClient(Client\Scoring\ScoringClient::class);
    }

    public function createSmartLinkClient(): Client\Smartlink\SmartLinkClientInterface
    {
        return $this->createClient(Client\Smartlink\SmartLinkClient::class);
    }

    public function createUserClient(): Client\User\UserClientInterface
    {
        return $this->createClient(Client\User\UserClient::class);
    }

    public function createWorkflowClient(): Client\Workflow\WorkflowClientInterface
    {
        return $this->createClient(Client\Workflow\WorkflowClient::class);
    }

    public function createBlackListClient(): Client\Blacklist\BlackListClientInterface
    {
        return $this->createClient(Client\Blacklist\BlackListClient::class);
    }

    public function createWebhookClient(): Client\Webhook\WebhookClientInterface
    {
        return $this->createClient(Client\Webhook\WebhookClient::class);
    }

    public function createMilestoneClient(): Client\Milestone\MilestoneClientInterface
    {
        return $this->createClient(Client\Milestone\MilestoneClient::class);
    }

    public function createMarketplaceClient(): Client\Marketplace\MarketplaceClientInterface
    {
        return $this->createClient(Client\Marketplace\MarketplaceClient::class);
    }
    
    public function createCouponListClient(): Client\CouponList\CouponListClientInterface
    {
        return $this->createClient(Client\CouponList\CouponListClient::class);
    }
}
