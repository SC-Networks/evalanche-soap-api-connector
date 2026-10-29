<?php

namespace Scn\EvalancheSoapApiConnector\Client\Profile;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileActivityScoreInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileGroupScoreInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistoryInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupMemberShipInterface;

/**
 * Class ProfileClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Profile
 */
final class ProfileClient extends AbstractClient implements ProfileClientInterface
{
    const PORTNAME = 'profile';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     *
     * @throws EmptyResultException
     */
    public function addScore(int $profileId, int $scoringGroupId, int $score, string $title): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->addScore([
                'profile_id' => $profileId,
                'scoring_group_id' => $scoringGroupId,
                'score' => $score,
                'name' => $title
            ]),
            'addScoreResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function create(int $id, HashMapInterface $hashMap): int
    {
        return $this->responseMapper->getInteger(
            $this->soapClient->create(
                [
                    'pool_id' => $id,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'createResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function delete(array $ids): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->delete(
                [
                    'profile_ids' => $ids
                ]
            ),
            'deleteResult'
        );
    }

    /**
     * @return ProfileActivityScoreInterface[]
     * @throws EmptyResultException
     */
    public function getActivityScoringHistory(
        int $id,
        int $scoringGroupId,
        int $scoringTypeId,
        int $resourceId,
        int $startTimestamp,
        int $endTimestamp
    ): array {
        return $this->responseMapper->getObjects(
            $this->soapClient->getActivityScoringHistory(
                [
                    'profile_id' => $id,
                    'scoring_group_id' => $scoringGroupId,
                    'scoring_type_id' => $scoringTypeId,
                    'resource_id' => $resourceId,
                    'start_timestamp' => $startTimestamp,
                    'end_timestamp' => $endTimestamp
                ]
            ),
            'getActivityScoringHistoryResult',
            $this->hydratorConfigFactory->createProfileActivityScoreConfig()
        );
    }

    /**
     * @param string[] $poolAttributeList
     *
     * @return ProfileBounceStatusInterface[]
     * @throws EmptyResultException
     */
    public function getBounces(int $id, array $poolAttributeList, int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getBounces(
                [
                    'pool_id' => $id,
                    'start_time' => $timestampStart,
                    'end_time' => $timestampEnd,
                    'pool_attribute_list' => $poolAttributeList
                ]
            ),
            'getBouncesResult',
            $this->hydratorConfigFactory->createProfileBounceStatusConfig()
        );
    }

    /**
     * @param int|string $id
     *
     * @throws EmptyResultException
     */
    public function getById($id): HashMapInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getById(
                [
                    'profile_id' => $id,
                ]
            ),
            'getByIdResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getByKey(int $id, string $key, string $value, array $poolAttributeList): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByKey(
                [
                    'pool_id' => $id,
                    'key' => $key,
                    'value' => $value,
                    'pool_attribute_list' => $poolAttributeList
                ]
            ),
            'getByKeyResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     * @param string[] $poolAttributeList
     *
     * @throws EmptyResultException
     */
    public function getByPool(int $id, array $poolAttributeList): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getByPool(
                [
                    'pool_id' => $id,
                    'pool_attribute_list' => $poolAttributeList
                ]
            ),
            'getByPoolResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param string[] $poolAttributeList
     *
     * @throws EmptyResultException
     */
    public function getByTargetGroup(int $id, array $poolAttributeList): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getByTargetGroup(
                [
                    'targetgroup_id' => $id,
                    'pool_attribute_list' => $poolAttributeList
                ]
            ),
            'getByTargetGroupResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param string[] $attributes
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getGrantedPermissions(int $id, array $attributes, int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getGrantedPermissions(
                [
                    'pool_id' => $id,
                    'attributes' => $attributes,
                    'start_time' => $timestampStart,
                    'end_time' => $timestampEnd,
                ]
            ),
            'getGrantedPermissionsResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getJobInformationByJobId(string $id): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getJobInformation(
                [
                    'job_id' => $id,
                ]
            ),
            'getJobInformationResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     *
     * @return MailingStatusInterface[]
     * @throws EmptyResultException
     */
    public function getMailingStatus(int $id, int $mailingId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getMailingStatus(
                [
                    'profile_id' => $id,
                    'mailing_id' => $mailingId
                ]
            ),
            'getMailingStatusResult',
            $this->hydratorConfigFactory->createMailingStatusConfig()
        );
    }

    /**
     * @param string[] $attributes
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getModifiedProfiles(int $id, array $attributes, int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getModifiedProfiles(
                [
                    'pool_id' => $id,
                    'attributes' => $attributes,
                    'start_time' => $timestampStart,
                    'end_time' => $timestampEnd,
                ]
            ),
            'getModifiedProfilesResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getResultCursorByJobId(string $id): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->getResultCursor(
                [
                    'job_id' => $id
                ]
            ),
            'getResultCursorResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getResultByJobId(string $id): JobResultInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getResults(
                [
                    'job_id' => $id
                ]
            ),
            'getResultsResult',
            $this->hydratorConfigFactory->createJobResultConfig()
        );
    }

    /**
     *
     * @return ProfileGroupScoreInterface[]
     * @throws EmptyResultException
     */
    public function getScoresByProfileId(string $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getScores(
                [
                    'profile_id' => $id,
                ]
            ),
            'getScoresResult',
            $this->hydratorConfigFactory->createProfileGroupScoreConfig()
        );
    }

    /**
     * @param string[] $poolAttributeList
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getUnsubscriptions(int $id, array $poolAttributeList, int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getUnsubscriptions(
                [
                    'pool_id' => $id,
                    'start_time' => $timestampStart,
                    'end_time' => $timestampEnd,
                    'pool_attribute_list' => $poolAttributeList
                ]
            ),
            'getUnsubscriptionsResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function grantPermission(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->grantPermission(
                [
                    'profile_id' => $id,
                ]
            ),
            'grantPermissionResult'
        );
    }

    /**
     * @param int[] $targetGroupIds
     *
     * @return TargetGroupMemberShipInterface[]
     * @throws EmptyResultException
     */
    public function isInTargetgroups(int $id, array $targetGroupIds): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->isInTargetgroups(
                [
                    'profile_id' => $id,
                    'targetgroup_ids' => $targetGroupIds
                ]
            ),
            'isInTargetgroupsResult',
            $this->hydratorConfigFactory->createTargetGroupMemberShipConfig()
        );
    }

    /**
     * @param string[] $attributes
     * @param string[][] $data
     *
     * @throws EmptyResultException
     */
    public function massUpdate(
        int $id,
        string $keyAttributeTitle,
        array $attributes,
        array $data,
        bool $merge,
        bool $ignoreMissing
    ): MassUpdateResultInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->massUpdate(
                [
                    'pool_id' => $id,
                    'key_attribute_name' => $keyAttributeTitle,
                    'attributes' => $attributes,
                    'data' => $data,
                    'merge' => $merge,
                    'ignore_missing' => $ignoreMissing
                ]
            ),
            'massUpdateResult',
            $this->hydratorConfigFactory->createMassUpdateResultConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function mergeById(string $id, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->mergeById(
                [
                    'profile_id' => $id,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'mergeByIdResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function mergeByKey(int $id, string $key, string $value, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->mergeByKey(
                [
                    'pool_id' => $id,
                    'key' => $key,
                    'value' => $value,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'mergeByKeyResult'
        );
    }

    public function mergeByPoolId(int $id, HashMapInterface $hashMap): void
    {
        $this->soapClient->mergeByPool(
            [
                'pool_id' => $id,
                'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
            ]
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function mergeByTargetGroupId(int $id, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->mergeByTargetGroup(
                [
                    'target_group_id' => $id,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'mergeByTargetGroupResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function revokePermission(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->revokePermission(
                [
                    'profile_id' => $id,
                ]
            ),
            'revokePermissionResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function revokeTracking(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->revokeTracking(
                [
                    'profile_id' => $id,
                ]
            ),
            'revokeTrackingResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function setResultCursor(string $id, int $cursor): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->setResultCursor(
                [
                    'job_id' => $id,
                    'cursor' => $cursor,
                ]
            ),
            'setResultCursorResult'
        );
    }

    /**
     * @param string[] $values
     *
     * @throws EmptyResultException
     */
    public function tagWithOption(int $id, array $values, string $key, bool $doUpdate): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->tagWithOption(
                [
                    'pool_attribute_option_id' => $id,
                    'values' => $values,
                    'key' => $key,
                    'set_profile_edit_date_and_fire_update_event' => $doUpdate
                ]
            ),
            'tagWithOptionResult'
        );
    }

    /**
     * @param string[] $values
     *
     * @throws EmptyResultException
     */
    public function unTagWithOption(int $id, array $values, string $key, bool $doUpdate): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->untagWithOption(
                [
                    'pool_attribute_option_id' => $id,
                    'values' => $values,
                    'key' => $key,
                    'set_profile_edit_date_and_fire_update_event' => $doUpdate
                ]
            ),
            'untagWithOptionResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function updateById(int $id, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->updateById(
                [
                    'profile_id' => $id,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'updateByIdResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function updateByKey(int $id, string $key, string $value, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->updateByKey(
                [
                    'pool_id' => $id,
                    'key' => $key,
                    'value' => $value,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'updateByKeyResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function updateByPoolId(int $id, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->updateByPool(
                [
                    'pool_id' => $id,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'updateByPoolResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function updateByTargetGroupId(int $id, HashMapInterface $hashMap): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->updateByTargetGroup(
                [
                    'target_group_id' => $id,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'updateByTargetGroupResult'
        );
    }

    /**
     *
     * @return ProfileTrackingHistoryInterface[]
     * @throws EmptyResultException
     */
    public function getTrackingHistory(
        int $profileId,
        int $timestampStart,
        int $timestampEnd
    ): array {
        return $this->responseMapper->getObjects(
            $this->soapClient->getTrackingHistory(
                [
                    'profile_id' => $profileId,
                    'from' => $timestampStart,
                    'to' => $timestampEnd
                ]
            ),
            'getTrackingHistoryResult',
            $this->hydratorConfigFactory->createProfileTrackingHistoryConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function setMilestone(int $profileId, int $milestoneId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->setMilestone([
                'profile_id' => $profileId,
                'milestone_id' => $milestoneId
            ]),
            'setMilestoneResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function hasMilestone(
        int $profileId,
        int $milestoneId,
        int $timestampStart,
        int $timestampEnd
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->hasMilestone([
                'profile_id' => $profileId,
                'milestone_id' => $milestoneId,
                'from' => $timestampStart,
                'to' => $timestampEnd
            ]),
            'hasMilestoneResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getByMilestone(
        int $milestoneId,
        array $poolAttributeList,
        int $timestampStart,
        int $timestampEnd
    ): JobHandleInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->getByMilestone(
                [
                    'milestone_id' => $milestoneId,
                    'pool_attribute_list' => $poolAttributeList,
                    'from' => $timestampStart,
                    'to' => $timestampEnd
                ]
            ),
            'getByMilestoneResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }
}
