<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config;

/**
 * Trait HydratorConfigFactoryInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
interface HydratorConfigFactoryInterface
{

    /**
     * @return HydratorConfigInterface
     */
    public function createWorkflowDetailConfig(): HydratorConfigInterface;

    /**
     * @return HydratorConfigInterface
     */
    public function createResourceInformationConfig(): HydratorConfigInterface;

    /**
     * @return HydratorConfigInterface
     */
    public function createUserConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createSmartLinkConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createScoringGroupDetailConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createPoolAttributeConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMandatorConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createArticleStatisticConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createArticleStatisticItemConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createHashMapConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeGroupConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeOptionConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createContainerAttributeRoleTypeConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createFolderInformationConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createTargetGroupDetailConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createFormStatisticConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createServiceStatusConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createClientStatisticConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailClientStatisticItemConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileActivityScoreConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileBounceStatusConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createJobHandleConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingStatusConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createJobResultConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileGroupScoreConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createResourceTypeInformationConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createTargetGroupMemberShipConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMassUpdateResultConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingArticleConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingDetailConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingClickConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingConfigurationConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingImpressionConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingStatisticConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createMailingSubjectConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createBlackListConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createAccountConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createDiscountConfig(): HydratorConfigInterface;

    /**
     *
     * @return HydratorConfigInterface
     */
    public function createProfileTrackingHistoryConfig(): HydratorConfigInterface;
}
