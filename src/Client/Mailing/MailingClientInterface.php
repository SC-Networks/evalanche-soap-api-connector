<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\CategoryInformationInterface;
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
interface MailingClientInterface extends ClientInterface
{
    /**
     * @param int $id
     * @param array $articles
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;

    /**
     * @param int $id
     *
     * @return ClientStatisticInterface
     * @throws EmptyResultException
     */
    public function getClientStatisticById(int $id): ClientStatisticInterface;

    /**
     * @param string $title
     * @param int $templateId
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function createDraft(string $title, int $templateId, int $categoryId): ResourceInformationInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getAllArticleImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getAllLinkClickProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param int $articleId
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getArticleImpressionProfiles(int $id, int $articleId, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByMailingId(int $id): array;

    /**
     * @param int $id
     *
     * @return ArticleStatisticInterface[]
     * @throws EmptyResultException
     */
    public function getArticleStatistics(int $id): array;

    /**
     * @param int $id
     * @param array $attributeName
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getBounceProfiles(int $id, array $attributeName): JobHandleInterface;

    /**
     * @param int $id
     * @param int $mandatorId
     *
     * @return MailingDetailInterface[]
     * @throws EmptyResultException
     */
    public function getByTypeId(int $id, int $mandatorId): array;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getClickProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return MailingClickInterface[]
     * @throws EmptyResultException
     */
    public function getClicks(int $id, int $timestampStart, int $timestampEnd): array;

    /**
     * @param int $id
     *
     * @return MailingConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): MailingConfigurationInterface;

    /**
     * @param int $id
     *
     * @return MailingDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): MailingDetailInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getHardbounceProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return MailingImpressionInterface[]
     * @throws EmptyResultException
     */
    public function getImpressions(int $id, int $timestampStart, int $timestampEnd): array;

    /**
     * @param string $id
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getJobInformation(string $id): JobHandleInterface;

    /**
     * @param int $id
     * @param int $linkId
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getLinkClickProfiles(int $id, int $linkId, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getMultipleClickProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getMultipleImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getRecipientsProfiles(int $id, array $attributeTitles): JobHandleInterface;

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
    public function getResults(string $id): JobResultInterface;

    /**
     * @param bool $unSent
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSendableDrafts(bool $unSent): array;

    /**
     * @param int $id
     * @param bool $unSent
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSendableDraftsByMandatorId(int $id, bool $unSent): array;

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getSoftbounceProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     * @param int $id
     *
     * @return MailingStatisticInterface
     * @throws EmptyResultException
     */
    public function getStatisticsByMailingId(int $id): MailingStatisticInterface;

    /**
     * @param int $id
     * @param int $timeFrame
     * @param array $profileAttributes
     *
     * @return MailingStatusInterface[]
     * @throws EmptyResultException
     */
    public function getStatus(int $id, int $timeFrame, array $profileAttributes): array;

    /**
     * @param int $id
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
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getUnsubscriptionProfiles(int $id, array $attributeTitles): JobHandleInterface;

    /**
     *
     * @return ServiceStatusInterface
     * @throws EmptyResultException
     */
    public function getServiceAvailable(): ServiceStatusInterface;

    /**
     * @param int $id
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function move(int $id, int $categoryId): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     * @param int $id
     * @param array $referenceIds
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array;

    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface;

    /**
     * @param int $id
     * @param array $profileIds
     *
     * @return int[]
     * @throws EmptyResultException
     */
    public function sendToProfiles(int $id, array $profileIds): array;

    /**
     * @param int $id
     * @param int $targetGroupId
     * @param int $sendTime
     * @param int $speed
     *
     * @return MailingDetailInterface
     * @throws EmptyResultException
     */
    public function sendToTargetGroup(int $id, int $targetGroupId, int $sendTime, int $speed): MailingDetailInterface;

    /**
     * @param int $id
     * @param MailingConfigurationInterface $configuration
     *
     * @return MailingConfigurationInterface
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        MailingConfigurationInterface $configuration
    ): MailingConfigurationInterface;

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
     * @param array $subjects
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function setSubjects(int $id, array $subjects): bool;

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function delete(int $id): bool;

    /**
     * @param int $id
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function copy(int $id, int $categoryId): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getListByMandatorId(int $id): array;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByCategoryId(int $id): array;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getById(int $id): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return CategoryInformationInterface
     * @throws EmptyResultException
     */
    public function getDefaultCategoryByCustomerId(int $id): CategoryInformationInterface;

    /**
     * @param string $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getByExternalId(string $id): ResourceInformationInterface;
}
