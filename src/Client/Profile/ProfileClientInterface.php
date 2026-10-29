<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Profile;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistoryInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupMemberShipInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileActivityScoreInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileGroupScoreInterface;

/**
 * Interface ProfileClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Profile
 */
interface ProfileClientInterface extends ClientInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function addScore(int $profileId, int $scoringGroupId, int $score, string $title): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function create(int $id, HashMapInterface $hashMap): int;

    /**
     *
     * @throws EmptyResultException
     */
    public function delete(array $ids): bool;

    /**
     *
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
    ): array;

    /**
     * @param string[] $poolAttributeList
     *
     * @return ProfileBounceStatusInterface[]
     * @throws EmptyResultException
     */
    public function getBounces(int $id, array $poolAttributeList, int $timestampStart, int $timestampEnd): array;

    /**
     * @param int|string $id
     *
     * @throws EmptyResultException
     */
    public function getById($id): HashMapInterface;

    /**
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getByKey(int $id, string $key, string $value, array $poolAttributeList): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getByPool(int $id, array $poolAttributeList): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getByTargetGroup(int $id, array $poolAttributeList): JobHandleInterface;

    /**
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getGrantedPermissions(int $id, array $attributes, int $timestampStart, int $timestampEnd): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getJobInformationByJobId(string $id): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getMailingStatus(int $id, int $mailingId): array;

    /**
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getModifiedProfiles(int $id, array $attributes, int $timestampStart, int $timestampEnd): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getResultCursorByJobId(string $id): string;

    /**
     *
     * @throws EmptyResultException
     */
    public function getResultByJobId(string $id): JobResultInterface;

    /**
     *
     * @return ProfileGroupScoreInterface[]
     * @throws EmptyResultException
     */
    public function getScoresByProfileId(string $id): array;

    /**
     * @param string[] $poolAttributeList
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getUnsubscriptions(
        int $id,
        array $poolAttributeList,
        int $timestampStart,
        int $timestampEnd
    ): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function grantPermission(int $id): bool;

    /**
     *
     * @return TargetGroupMemberShipInterface[]
     * @throws EmptyResultException
     */
    public function isInTargetgroups(int $id, array $targetGroupIds): array;

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
    ): MassUpdateResultInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function mergeById(string $id, HashMapInterface $hashMap): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function mergeByKey(int $id, string $key, string $value, HashMapInterface $hashMap): bool;

    public function mergeByPoolId(int $id, HashMapInterface $hashMap): void;

    /**
     *
     * @throws EmptyResultException
     */
    public function mergeByTargetGroupId(int $id, HashMapInterface $hashMap): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function revokePermission(int $id): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function revokeTracking(int $id): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function setResultCursor(string $id, int $cursor): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function tagWithOption(int $id, array $values, string $key, bool $doUpdate): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function unTagWithOption(int $id, array $values, string $key, bool $doUpdate): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateById(int $id, HashMapInterface $hashMap): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateByKey(int $id, string $key, string $value, HashMapInterface $hashMap): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateByPoolId(int $id, HashMapInterface $hashMap): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateByTargetGroupId(int $id, HashMapInterface $hashMap): bool;

    /**
     *
     * @return ProfileTrackingHistoryInterface[]
     * @throws EmptyResultException
     */
    public function getTrackingHistory(
        int $profileId,
        int $timestampStart,
        int $timestampEnd
    ): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function setMilestone(int $profileId, int $milestoneId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function hasMilestone(
        int $profileId,
        int $milestoneId,
        int $timestampStart,
        int $timestampEnd
    ): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function getByMilestone(
        int $milestoneId,
        array $poolAttributeList,
        int $timestampStart,
        int $timestampEnd
    ): JobHandleInterface;
}
