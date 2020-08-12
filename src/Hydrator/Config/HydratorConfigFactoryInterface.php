<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config;

interface HydratorConfigFactoryInterface
{
    public function createWorkflowDetailConfig(): HydratorConfigInterface;
    
    public function createResourceInformationConfig(): HydratorConfigInterface;
    
    public function createUserConfig(): HydratorConfigInterface;

    public function createSmartLinkConfig(): HydratorConfigInterface;

    public function createScoringGroupDetailConfig(): HydratorConfigInterface;

    public function createPoolAttributeConfig(): HydratorConfigInterface;

    public function createMandatorConfig(): HydratorConfigInterface;

    public function createArticleStatisticConfig(): HydratorConfigInterface;

    public function createArticleStatisticItemConfig(): HydratorConfigInterface;

    public function createHashMapConfig(): HydratorConfigInterface;

    public function createContainerAttributeConfig(): HydratorConfigInterface;

    public function createContainerAttributeGroupConfig(): HydratorConfigInterface;

    public function createContainerAttributeOptionConfig(): HydratorConfigInterface;

    public function createContainerAttributeRoleTypeConfig(): HydratorConfigInterface;

    public function createFolderInformationConfig(): HydratorConfigInterface;

    public function createTargetGroupDetailConfig(): HydratorConfigInterface;

    public function createFormStatisticConfig(): HydratorConfigInterface;

    public function createServiceStatusConfig(): HydratorConfigInterface;

    public function createClientStatisticConfig(): HydratorConfigInterface;

    public function createMailClientStatisticItemConfig(): HydratorConfigInterface;

    public function createProfileActivityScoreConfig(): HydratorConfigInterface;

    public function createProfileBounceStatusConfig(): HydratorConfigInterface;

    public function createJobHandleConfig(): HydratorConfigInterface;

    public function createMailingStatusConfig(): HydratorConfigInterface;

    public function createJobResultConfig(): HydratorConfigInterface;

    public function createProfileGroupScoreConfig(): HydratorConfigInterface;

    public function createResourceTypeInformationConfig(): HydratorConfigInterface;

    public function createTargetGroupMemberShipConfig(): HydratorConfigInterface;

    public function createMassUpdateResultConfig(): HydratorConfigInterface;

    public function createMailingArticleConfig(): HydratorConfigInterface;

    public function createMailingDetailConfig(): HydratorConfigInterface;

    public function createMailingClickConfig(): HydratorConfigInterface;

    public function createMailingConfigurationConfig(): HydratorConfigInterface;

    public function createMailingImpressionConfig(): HydratorConfigInterface;

    public function createMailingStatisticConfig(): HydratorConfigInterface;

    public function createMailingSubjectConfig(): HydratorConfigInterface;

    public function createBlackListConfig(): HydratorConfigInterface;

    public function createAccountConfig(): HydratorConfigInterface;

    public function createDiscountConfig(): HydratorConfigInterface;

    public function createProfileTrackingHistoryConfig(): HydratorConfigInterface;

    public function createMarketplaceCategoryConfig(): HydratorConfigInterface;

    public function createMarketplaceProductConfig(): HydratorConfigInterface;
}
