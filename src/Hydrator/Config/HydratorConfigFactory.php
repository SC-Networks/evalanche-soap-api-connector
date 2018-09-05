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

/**
 * Class HydratorConfigFactory
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
final class HydratorConfigFactory implements HydratorConfigFactoryInterface
{
    /**
     * @return HydratorConfigInterface
     */
    public function createWorkflowDetailConfig(): HydratorConfigInterface
    {
        return new WorkflowDetailConfig();
    }

    /**
     * @return HydratorConfigInterface
     */
    public function createResourceInformationConfig(): HydratorConfigInterface
    {
        return new ResourceInformationConfig();
    }

    /**
     * @return HydratorConfigInterface
     */
    public function createUserConfig(): HydratorConfigInterface
    {
        return new UserConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createSmartLinkConfig(): HydratorConfigInterface
    {
        return new SmartLinkConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createScoringGroupDetailConfig(): HydratorConfigInterface
    {
        return new ScoringGroupDetailConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createPoolAttributeConfig(): HydratorConfigInterface
    {
        return new PoolAttributeConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMandatorConfig(): HydratorConfigInterface
    {
        return new MandatorConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createArticleStatisticConfig(): HydratorConfigInterface
    {
        return new ArticleStatisticConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createArticleStatisticItemConfig(): HydratorConfigInterface
    {
        return new ArticleStatisticItemConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createHashMapConfig(): HydratorConfigInterface
    {
        return new HashMapConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeGroupConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeGroupConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeOptionConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeOptionConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeRoleTypeConfig(): HydratorConfigInterface
    {
        return new ContainerAttributeRoleTypeConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createFolderInformationConfig(): HydratorConfigInterface
    {
        return new FolderInformationConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createTargetGroupDetailConfig(): HydratorConfigInterface
    {
        return new TargetGroupDetailConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createFormStatisticConfig(): HydratorConfigInterface
    {
        return new FormStatisticConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createServiceStatusConfig(): HydratorConfigInterface
    {
        return new ServiceStatusConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createClientStatisticConfig(): HydratorConfigInterface
    {
        return new ClientStatisticConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailClientStatisticItemConfig(): HydratorConfigInterface
    {
        return new MailClientStatisticItemConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileActivityScoreConfig(): HydratorConfigInterface
    {
        return new ProfileActivityScoreConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileBounceStatusConfig(): HydratorConfigInterface
    {
        return new ProfileBounceStatusConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createJobHandleConfig(): HydratorConfigInterface
    {
        return new JobHandleConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingStatusConfig(): HydratorConfigInterface
    {
        return new MailingStatusConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createJobResultConfig(): HydratorConfigInterface
    {
        return new JobResultConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileGroupScoreConfig(): HydratorConfigInterface
    {
        return new ProfileGroupScoreConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createResourceTypeInformationConfig(): HydratorConfigInterface
    {
        return new ResourceTypeInformationConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createTargetGroupMemberShipConfig(): HydratorConfigInterface
    {
        return new TargetGroupMemberShipConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMassUpdateResultConfig(): HydratorConfigInterface
    {
        return new MassUpdateResultConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingArticleConfig(): HydratorConfigInterface
    {
        return new MailingArticleConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingDetailConfig(): HydratorConfigInterface
    {
        return new MailingDetailConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingClickConfig(): HydratorConfigInterface
    {
        return new MailingClickConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingConfigurationConfig(): HydratorConfigInterface
    {
        return new MailingConfigurationConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingImpressionConfig(): HydratorConfigInterface
    {
        return new MailingImpressionConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingStatisticConfig(): HydratorConfigInterface
    {
        return new MailingStatisticConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingSubjectConfig(): HydratorConfigInterface
    {
        return new MailingSubjectConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createBlackListConfig(): HydratorConfigInterface
    {
        return new BlackListConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createAccountConfig(): HydratorConfigInterface
    {
        return new AccountConfig();
    }

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createDiscountConfig(): HydratorConfigInterface
    {
        return new DiscountConfig();
    }
}