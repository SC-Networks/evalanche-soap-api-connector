<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ContentGenerationInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\EditorModulesTypesTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticleInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingClickInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingImpressionInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSubjectInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\ArticleStatisticInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\ClientStatisticInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailingStatisticInterface;

/**
 * Interface MailingClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
interface MailingClientInterface extends
    ContentGenerationInterface,
    ResourceTraitInterface,
    EditorModulesTypesTraitInterface,
    ClientInterface
{
    /**
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getClientStatisticById(int $id): ClientStatisticInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function createDraft(
        string $title,
        int $templateId,
        int $folderId,
        ?int $typeId = null
    ): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getAllArticleImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getAllLinkClickProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getArticleImpressionProfiles(int $id, int $articleId, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByMailingId(int $id): array;

    /**
     *
     * @return ArticleStatisticInterface[]
     * @throws EmptyResultException
     */
    public function getArticleStatistics(int $id): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getBounceProfiles(int $id, array $attributeName): JobHandleInterface;

    /**
     *
     * @return MailingDetailInterface[]
     * @throws EmptyResultException
     */
    public function getByTypeId(int $id, int $mandatorId): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getClickProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @return MailingClickInterface[]
     * @throws EmptyResultException
     */
    public function getClicks(int $id, int $timestampStart, int $timestampEnd): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): MailingConfigurationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): MailingDetailInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getHardbounceProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @return MailingImpressionInterface[]
     * @throws EmptyResultException
     */
    public function getImpressions(int $id, int $timestampStart, int $timestampEnd): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getJobInformation(string $id): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getLinkClickProfiles(int $id, int $linkId, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getMultipleClickProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getMultipleImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getRecipientsProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getResultCursorByJobId(string $id): string;

    /**
     *
     * @throws EmptyResultException
     */
    public function getResults(string $id): JobResultInterface;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSendableDrafts(bool $unSent): array;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSendableDraftsByMandatorId(int $id, bool $unSent): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getSoftbounceProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getStatisticsByMailingId(int $id): MailingStatisticInterface;

    /**
     *
     * @return MailingStatusInterface[]
     * @throws EmptyResultException
     */
    public function getStatus(int $id, int $timeFrame, array $profileAttributes): array;

    /**
     *
     * @return MailingSubjectInterface[]
     * @throws EmptyResultException
     */
    public function getSubjectsByMailingId(int $id): array;

    /**
     *
     * @return ResourceTypeInformationInterface[]
     * @throws EmptyResultException
     */
    public function getTypeIds(): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getUnsubscriptionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getServiceAvailable(): ServiceStatusInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function move(int $id, int $folderId): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface;

    /**
     *
     * @return int[]
     * @throws EmptyResultException
     */
    public function sendToProfiles(int $id, array $profileIds): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function sendToTargetGroup(int $id, int $targetGroupId, int $sendTime, int $speed): MailingDetailInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        MailingConfigurationInterface $configuration
    ): MailingConfigurationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function setResultCursor(string $id, int $cursor): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function setSubjects(int $id, array $subjects): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function delete(int $id): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function copy(int $id, int $folderId): ResourceInformationInterface;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getListByMandatorId(int $id): array;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByFolderId(int $id): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getById(int $id): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDefaultFolderByMandatorId(int $id): FolderInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getByExternalId(string $id): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getContentContainerData(int $mailingId): HashMapInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function setContentContainerData(int $mailingId, HashMapInterface $hashMap): ResourceInformationInterface;
}
