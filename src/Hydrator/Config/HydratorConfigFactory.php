<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Account\AccountConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Account\DiscountConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist\BlackListConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeGroupConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeOptionConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeRoleTypeConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\FolderInformationConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\HashMapConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\JobHandleConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\JobResultConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\MassUpdateResultConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\ResourceInformationConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\ResourceTypeInformationConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\ServiceStatusConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate\MailingTemplateConfigurationConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate\MailingTemplateSourcesConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace\CategoryConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace\ProductConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile\ProfileTrackingHistoryConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup\TargetGroupDetailConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup\TargetGroupMemberShipConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingArticleConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingClickConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingConfigurationConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingDetailConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingImpressionConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingStatusConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingSubjectConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mandator\MandatorConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool\PoolAttributeConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile\ProfileActivityScoreConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile\ProfileBounceStatusConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile\ProfileGroupScoreConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Scoring\ScoringGroupDetailConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink\SmartLinkConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\ArticleStatisticConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\ArticleStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\ClientStatisticConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\FormStatisticConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\MailClientStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\MailingStatisticConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\User\UserConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow\WorkflowDetailConfig;

final class HydratorConfigFactory implements HydratorConfigFactoryInterface
{
    public function createWorkflowDetailConfig(): HydratorConfigInterface
    {
        return new WorkflowDetailConfig();
    }

    public function createResourceInformationConfig(): HydratorConfigInterface
    {
        return new ResourceInformationConfig();
    }

    public function createUserConfig(): HydratorConfigInterface
    {
        return new UserConfig();
    }

    public function createSmartLinkConfig(): HydratorConfigInterface
    {
        return new SmartLinkConfig();
    }

    public function createScoringGroupDetailConfig(): HydratorConfigInterface
    {
        return new ScoringGroupDetailConfig();
    }

    public function createPoolAttributeConfig(): HydratorConfigInterface
    {
        return new PoolAttributeConfig();
    }

    public function createMandatorConfig(): HydratorConfigInterface
    {
        return new MandatorConfig();
    }

    public function createArticleStatisticConfig(): HydratorConfigInterface
    {
        return new ArticleStatisticConfig();
    }

    public function createArticleStatisticItemConfig(): HydratorConfigInterface
    {
        return new ArticleStatisticItemConfig();
    }

    public function createHashMapConfig(): HydratorConfigInterface
    {
        return new HashMapConfig();
    }

    public function createContainerAttributeConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeConfig();
    }

    public function createContainerAttributeGroupConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeGroupConfig();
    }

    public function createContainerAttributeOptionConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeOptionConfig();
    }

    public function createContainerAttributeRoleTypeConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeRoleTypeConfig();
    }

    public function createFolderInformationConfig(): HydratorConfigInterface
    {
        return new FolderInformationConfig();
    }

    public function createTargetGroupDetailConfig(): HydratorConfigInterface
    {
        return new TargetGroupDetailConfig();
    }

    public function createFormStatisticConfig(): HydratorConfigInterface
    {
        return new FormStatisticConfig();
    }

    public function createServiceStatusConfig(): HydratorConfigInterface
    {
        return new ServiceStatusConfig();
    }

    public function createClientStatisticConfig(): HydratorConfigInterface
    {
        return new ClientStatisticConfig();
    }

    public function createMailClientStatisticItemConfig(): HydratorConfigInterface
    {
        return new MailClientStatisticItemConfig();
    }

    public function createProfileActivityScoreConfig(): HydratorConfigInterface
    {
        return new ProfileActivityScoreConfig();
    }

    public function createProfileBounceStatusConfig(): HydratorConfigInterface
    {
        return new ProfileBounceStatusConfig();
    }

    public function createJobHandleConfig(): HydratorConfigInterface
    {
        return new JobHandleConfig();
    }

    public function createMailingStatusConfig(): HydratorConfigInterface
    {
        return new MailingStatusConfig();
    }

    public function createJobResultConfig(): HydratorConfigInterface
    {
        return new JobResultConfig();
    }

    public function createProfileGroupScoreConfig(): HydratorConfigInterface
    {
        return new ProfileGroupScoreConfig();
    }

    public function createResourceTypeInformationConfig(): HydratorConfigInterface
    {
        return new ResourceTypeInformationConfig();
    }

    public function createTargetGroupMemberShipConfig(): HydratorConfigInterface
    {
        return new TargetGroupMemberShipConfig();
    }

    public function createMassUpdateResultConfig(): HydratorConfigInterface
    {
        return new MassUpdateResultConfig();
    }

    public function createMailingArticleConfig(): HydratorConfigInterface
    {
        return new MailingArticleConfig();
    }

    public function createMailingDetailConfig(): HydratorConfigInterface
    {
        return new MailingDetailConfig();
    }

    public function createMailingClickConfig(): HydratorConfigInterface
    {
        return new MailingClickConfig();
    }

    public function createMailingConfigurationConfig(): HydratorConfigInterface
    {
        return new MailingConfigurationConfig();
    }

    public function createMailingImpressionConfig(): HydratorConfigInterface
    {
        return new MailingImpressionConfig();
    }

    public function createMailingStatisticConfig(): HydratorConfigInterface
    {
        return new MailingStatisticConfig();
    }

    public function createMailingSubjectConfig(): HydratorConfigInterface
    {
        return new MailingSubjectConfig();
    }

    public function createBlackListConfig(): HydratorConfigInterface
    {
        return new BlackListConfig();
    }

    public function createAccountConfig(): HydratorConfigInterface
    {
        return new AccountConfig();
    }

    public function createDiscountConfig(): HydratorConfigInterface
    {
        return new DiscountConfig();
    }

    public function createProfileTrackingHistoryConfig(): HydratorConfigInterface
    {
        return new ProfileTrackingHistoryConfig();
    }

    public function createMarketplaceCategoryConfig(): HydratorConfigInterface
    {
        return new CategoryConfig();
    }

    public function createMarketplaceProductConfig(): HydratorConfigInterface
    {
        return new ProductConfig();
    }
    
    public function createMailingTemplateConfigurationConfig(): HydratorConfigInterface
    {
        return new MailingTemplateConfigurationConfig();
    }
    
    public function createMailingTemplateSourcesConfig(): HydratorConfigInterface
    {
        return new MailingTemplateSourcesConfig();
    }
}
