<?php

namespace Scn\EvalancheSoapApiConnector\Client\Profile;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatusInterface;
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
     * @param int $profileId
     * @param int $scoringGroupId
     * @param int $score
     * @param string $title
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function addScore(int $profileId, int $scoringGroupId, int $score, string $title): bool;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return int
     * @throws EmptyResultException
     */
    public function create(int $id, HashMapInterface $hashMap): int;

    /**
     * @param array $ids
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function delete(array $ids): bool;

    /**
     * @param int $id
     * @param int $scoringGroupId
     * @param int $scoringTypeId
     * @param int $resourceId
     * @param int $startTimestamp
     * @param int $endTimestamp
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
     * @param int $id
     * @param string[] $poolAttributeList
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return ProfileBounceStatusInterface[]
     * @throws EmptyResultException
     */
    public function getBounces(int $id, array $poolAttributeList, int $timestampStart, int $timestampEnd): array;

    /**
     * @param int $id
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getById(int $id): HashMapInterface;

    /**
     * @param int $id
     * @param string $key
     * @param string $value
     * @param array $poolAttributeList
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getByKey(int $id, string $key, string $value, array $poolAttributeList): array;

    /**
     * @param int $id
     * @param array $poolAttributeList
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getByPool(int $id, array $poolAttributeList): JobHandleInterface;

    /**
     * @param int $id
     * @param array $poolAttributeList
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getByTargetGroup(int $id, array $poolAttributeList): JobHandleInterface;

    /**
     * @param int $id
     * @param array $attributes
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getGrantedPermissions(int $id, array $attributes, int $timestampStart, int $timestampEnd): array;

    /**
     * @param string $id
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getJobInformationByJobId(string $id): JobHandleInterface;

    /**
     * @param int $id
     * @param int $mailingId
     *
     * @return array
     * @throws EmptyResultException
     */
    public function getMailingStatus(int $id, int $mailingId): array;

    /**
     * @param int $id
     * @param array $attributes
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return HashMapInterface[]
     * @throws EmptyResultException
     */
    public function getModifiedProfiles(int $id, array $attributes, int $timestampStart, int $timestampEnd): array;

    /**
     * @param string $id
     *
     * @return string
     * @throws EmptyResultException
     */
    public function getResultCursorByJobId(string $id): string;

    /**
     * @param string $id
     *
     * @return JobResultInterface
     * @throws EmptyResultException
     */
    public function getResultByJobId(string $id): JobResultInterface;

    /**
     * @param string $id
     *
     * @return ProfileGroupScoreInterface[]
     * @throws EmptyResultException
     */
    public function getScoresByProfileId(string $id): array;

    /**
     * @param int $id
     * @param string[] $poolAttributeList
     * @param int $timestampStart
     * @param int $timestampEnd
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
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function grantPermission(int $id): bool;

    /**
     * @param int $id
     * @param array $targetGroupIds
     *
     * @return TargetGroupMemberShipInterface[]
     * @throws EmptyResultException
     */
    public function isInTargetgroups(int $id, array $targetGroupIds): array;

    /**
     * @param int $id
     * @param string $keyAttributeName
     * @param string[] $attributes
     * @param string[] $data
     * @param bool $merge
     * @param bool $ignoreMissing
     *
     * @return MassUpdateResultInterface
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
     * @param string $id
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function mergeById(string $id, HashMapInterface $hashMap): bool;

    /**
     * @param int $id
     * @param string $key
     * @param string $value
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function mergeByKey(int $id, string $key, string $value, HashMapInterface $hashMap): bool;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return void
     */
    public function mergeByPool(int $id, HashMapInterface $hashMap): void;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function mergeByTargetGroup(int $id, HashMapInterface $hashMap): bool;

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function revokePermission(int $id): bool;

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function revokeTracking(int $id): bool;

    /**
     * @param string $id
     * @param int $cursor
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function setResultCursor(string $id, int $cursor): bool;

    /**
     * @param int $id
     * @param array $values
     * @param string $key
     * @param bool $doUpdate
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function tagWithOption(int $id, array $values, string $key, bool $doUpdate): bool;

    /**
     * @param int $id
     * @param array $values
     * @param string $key
     * @param bool $doUpdate
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function unTagWithOption(int $id, array $values, string $key, bool $doUpdate): bool;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function updateById(int $id, HashMapInterface $hashMap): bool;

    /**
     * @param int $id
     * @param string $key
     * @param string $value
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function updateByKey(int $id, string $key, string $value, HashMapInterface $hashMap): bool;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function updateByPoolId(int $id, HashMapInterface $hashMap): bool;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function updateByTargetGroupId(int $id, HashMapInterface $hashMap): bool;
}
