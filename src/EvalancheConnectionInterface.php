<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

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
use Scn\EvalancheSoapApiConnector\Client\LeadPage\LeadpageClientInterface;
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
use Scn\EvalancheSoapApiConnector\Client\Blacklist\BlackListClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Webhook\WebhookClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Milestone\MilestoneClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Marketplace\MarketplaceClientInterface;
use Scn\EvalancheSoapApiConnector\Client\CouponList\CouponListClientInterface;
use Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate\LeadpageTemplateClientInterface;

interface EvalancheConnectionInterface
{
    public static function create(string $hostname, string $username, string $password): EvalancheConnectionInterface;

    public function createAccountClient(): AccountClientInterface;

    public function createArticleClient(): ArticleClientInterface;

    public function createArticleTemplateClient(): ArticleTemplateClientInterface;

    public function createArticleTypeClient(): ArticleTypeClientInterface;

    public function createFolderClient(): FolderClientInterface;

    public function createContainerClient(): ContainerClientInterface;

    public function createContainerTypeClient(): ContainerTypeClientInterface;

    public function createDocumentClient(): DocumentClientInterface;

    public function createFormClient(): FormClientInterface;

    public function createTargetGroupClient(): TargetGroupClientInterface;

    public function createImageClient(): ImageClientInterface;

    public function createLeadpageClient(): LeadpageClientInterface;

    public function createMailingClient(): MailingClientInterface;

    public function createMailingTemplateClient(): MailingTemplateClientInterface;

    public function createMandatorClient(): MandatorClientInterface;

    public function createPoolClient(): PoolClientInterface;

    public function createPoolDataMinerClient(): PoolDataMinerClientInterface;

    public function createProfileClient(): ProfileClientInterface;

    public function createReportClient(): ReportClientInterface;

    public function createScoringClient(): ScoringClientInterface;

    public function createSmartLinkClient(): SmartLinkClientInterface;

    public function createUserClient(): UserClientInterface;

    public function createWorkflowClient(): WorkflowClientInterface;

    public function createBlackListClient(): BlackListClientInterface;

    public function createWebhookClient(): WebhookClientInterface;

    public function createMilestoneClient(): MilestoneClientInterface;

    public function createMarketplaceClient(): MarketplaceClientInterface;

    public function createCouponListClient(): CouponListClientInterface;

    public function createLeadpageTemplateClient(): LeadpageTemplateClientInterface;
}
