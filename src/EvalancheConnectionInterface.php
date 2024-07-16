<?php

namespace Scn\EvalancheSoapApiConnector;

interface EvalancheConnectionInterface
{
    public static function create(string $hostname, string $username, string $password): EvalancheConnectionInterface;

    public function createAccountClient(): Client\Account\AccountClientInterface;

    public function createArticleClient(): Client\Article\ArticleClientInterface;

    public function createArticleTemplateClient(): Client\Article\ArticleTemplateClientInterface;

    public function createArticleTypeClient(): Client\Article\ArticleTypeClientInterface;

    public function createFolderClient(): Client\Folder\FolderClientInterface;

    public function createContainerClient(): Client\Container\ContainerClientInterface;

    public function createContainerTypeClient(): Client\Container\ContainerTypeClientInterface;

    public function createDocumentClient(): Client\Document\DocumentClientInterface;

    public function createFormClient(): Client\Form\FormClientInterface;

    public function createTargetGroupClient(): Client\TargetGroup\TargetGroupClientInterface;

    public function createImageClient(): Client\Image\ImageClientInterface;

    public function createLeadpageClient(): Client\LeadPage\LeadpageClientInterface;

    public function createMailingClient(): Client\Mailing\MailingClientInterface;

    public function createMailingTemplateClient(): Client\Mailing\MailingTemplateClientInterface;

    public function createMandatorClient(): Client\Mandator\MandatorClientInterface;

    public function createPoolClient(): Client\Pool\PoolClientInterface;

    public function createPoolDataMinerClient(): Client\Pool\PoolDataMinerClientInterface;

    public function createProfileClient(): Client\Profile\ProfileClientInterface;

    public function createReportClient(): Client\Report\ReportClientInterface;

    public function createScoringClient(): Client\Scoring\ScoringClientInterface;

    public function createSmartLinkClient(): Client\Smartlink\SmartLinkClientInterface;

    public function createUserClient(): Client\User\UserClientInterface;

    public function createWorkflowClient(): Client\Workflow\WorkflowClientInterface;

    public function createBlackListClient(): Client\Blacklist\BlackListClientInterface;

    public function createWebhookClient(): Client\Webhook\WebhookClientInterface;

    public function createMilestoneClient(): Client\Milestone\MilestoneClientInterface;

    public function createMarketplaceClient(): Client\Marketplace\MarketplaceClientInterface;

    public function createCouponListClient(): Client\CouponList\CouponListClientInterface;
}
