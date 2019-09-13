<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
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
 * Class MailingClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
final class MailingClient extends AbstractClient implements MailingClientInterface
{
    const PORTNAME = 'mailing';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param array $articles
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->addArticles(
                [
                    'mailing_id' => $id,
                    'articles' => $this->extractor->extractArray(
                        $this->hydratorConfigFactory->createMailingArticleConfig(),
                        $articles
                    )
                ]
            ),
            'addArticlesResult',
            $this->hydratorConfigFactory->createMailingArticleConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ClientStatisticInterface
     * @throws EmptyResultException
     */
    public function getClientStatisticById(int $id): ClientStatisticInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getClientStatistics([
                'mailing_id' => $id
            ]),
            'getClientStatisticsResult',
            $this->hydratorConfigFactory->createClientStatisticConfig()
        );
    }

    /**
     * @param string $title
     * @param int $templateId
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function createDraft(string $title, int $templateId, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->createDraft(
                [
                    'name' => $title,
                    'template_id' => $templateId,
                    'category_id' => $folderId,
                ]
            ),
            'createDraftResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getAllArticleImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getAllArticleImpressionProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getAllArticleImpressionProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getAllLinkClickProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getAllLinkClickProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getAllLinkClickProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param int $articleId
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getArticleImpressionProfiles(int $id, int $articleId, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getArticleImpressionProfiles(
                [
                    'mailing_id' => $id,
                    'article_id' => $articleId,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getArticleImpressionProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByMailingId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getArticles([
                'mailing_id' => $id
            ]),
            'getArticlesResult',
            $this->hydratorConfigFactory->createMailingArticleConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ArticleStatisticInterface[]
     * @throws EmptyResultException
     */
    public function getArticleStatistics(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getArticleStatistics(
                [
                    'mailing_id' => $id
                ]
            ),
            'getArticleStatisticsResult',
            $this->hydratorConfigFactory->createArticleStatisticConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getBounceProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getBounceProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getBounceProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param int $mandatorId
     *
     * @return MailingDetailInterface[]
     * @throws EmptyResultException
     */
    public function getByTypeId(int $id, int $mandatorId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByTypeId(
                [
                    'type_id' => $id,
                    'mandator_id' => $mandatorId,
                ]
            ),
            'getByTypeIdResult',
            $this->hydratorConfigFactory->createMailingDetailConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getClickProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getClickProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles
                ]
            ),
            'getClickProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return MailingClickInterface[]
     * @throws EmptyResultException
     */
    public function getClicks(int $id, int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getClicks(
                [
                    'mailing_id' => $id,
                    'start_timestamp' => $timestampStart,
                    'end_timestamp' => $timestampEnd,
                ]
            ),
            'getClicksResult',
            $this->hydratorConfigFactory->createMailingClickConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return MailingConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): MailingConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getConfiguration(
                [
                    'mailing_id' => $id,
                ]
            ),
            'getConfigurationResult',
            $this->hydratorConfigFactory->createMailingConfigurationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return MailingDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): MailingDetailInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getDetails(
                [
                    'mailing_id' => $id,
                ]
            ),
            'getDetailsResult',
            $this->hydratorConfigFactory->createMailingDetailConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getHardbounceProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getHardbounceProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getHardbounceProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getImpressionProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles
                ]
            ),
            'getImpressionProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return MailingImpressionInterface[]
     * @throws EmptyResultException
     */
    public function getImpressions(int $id, int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getImpressions(
                [
                    'mailing_id' => $id,
                    'start_timestamp' => $timestampStart,
                    'end_timestamp' => $timestampEnd,
                ]
            ),
            'getImpressionsResult',
            $this->hydratorConfigFactory->createMailingImpressionConfig()
        );
    }

    /**
     * @param string $id
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getJobInformation(string $id): JobHandleInterface
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
     * @param int $id
     * @param int $linkId
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getLinkClickProfiles(int $id, int $linkId, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getLinkClickProfiles(
                [
                    'mailing_id' => $id,
                    'link_id' => $linkId,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getLinkClickProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getMultipleClickProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getMultipleClickProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getMultipleClickProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getMultipleImpressionProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getMultipleImpressionProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getMultipleImpressionProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getRecipientsProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getRecipientsProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getRecipientsProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param string $id
     *
     * @return string
     * @throws EmptyResultException
     */
    public function getResultCursorByJobId(string $id): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->getResultCursor([
                'job_id' => $id
            ]),
            'getResultCursorResult'
        );
    }

    /**
     * @param string $id
     *
     * @return JobResultInterface
     * @throws EmptyResultException
     */
    public function getResults(string $id): JobResultInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getResults(
                [
                    'job_id' => $id,
                ]
            ),
            'getResultsResult',
            $this->hydratorConfigFactory->createJobResultConfig()
        );
    }

    /**
     * @param bool $unSent
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSendableDrafts(bool $unSent): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getSendableDrafts(
                [
                    'unsent' => $unSent,
                ]
            ),
            'getSendableDraftsResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param bool $unSent
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSendableDraftsByMandatorId(int $id, bool $unSent): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getSendableDraftsByMandatorId(
                [
                    'mandator_id' => $id,
                    'unsent' => $unSent,
                ]
            ),
            'getSendableDraftsByMandatorIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getSoftbounceProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getSoftbounceProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getSoftbounceProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return MailingStatisticInterface
     * @throws EmptyResultException
     */
    public function getStatisticsByMailingId(int $id): MailingStatisticInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getStatistics(
                [
                    'mailing_id' => $id,
                ]
            ),
            'getStatisticsResult',
            $this->hydratorConfigFactory->createMailingStatisticConfig()
        );
    }

    /**
     * @param int $id
     * @param int $timeFrame
     * @param string[] $profileAttributes
     *
     * @return MailingStatusInterface[]
     * @throws EmptyResultException
     */
    public function getStatus(int $id, int $timeFrame, array $profileAttributes): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getStatus(
                [
                    'mailing_id' => $id,
                    'timeframe' => $timeFrame,
                    'profile_attributes' => $profileAttributes,
                ]
            ),
            'getStatusResult',
            $this->hydratorConfigFactory->createMailingStatusConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return MailingSubjectInterface[]
     * @throws EmptyResultException
     */
    public function getSubjectsByMailingId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getSubjects(
                [
                    'mailing_id' => $id,
                ]
            ),
            'getSubjectsResult',
            $this->hydratorConfigFactory->createMailingSubjectConfig()
        );
    }

    /**
     *
     * @return ResourceTypeInformationInterface[]
     * @throws EmptyResultException
     */
    public function getTypeIds(): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getTypeIds(),
            'getTypeIdsResult',
            $this->hydratorConfigFactory->createResourceTypeInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param array $attributeTitles
     *
     * @return JobHandleInterface
     * @throws EmptyResultException
     */
    public function getUnsubscriptionProfiles(int $id, array $attributeTitles): JobHandleInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getUnsubscriptionProfiles(
                [
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]
            ),
            'getUnsubscriptionProfilesResult',
            $this->hydratorConfigFactory->createJobHandleConfig()
        );
    }

    /**
     *
     * @return ServiceStatusInterface
     * @throws EmptyResultException
     */
    public function getServiceAvailable(): ServiceStatusInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->isAlive(),
            'isAliveResult',
            $this->hydratorConfigFactory->createServiceStatusConfig()
        );
    }

    /**
     * @param int $id
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function move(int $id, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->move(['resource_id' => $id, 'category_id' => $folderId]),
            'moveResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAllArticles([
                'mailing_id' => $id
            ]),
            'removeAllArticlesResult'
        );
    }

    /**
     * @param int $id
     * @param int[] $referenceIds
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->removeArticles(
                [
                    'mailing_id' => $id,
                    'reference_ids' => $referenceIds,
                ]
            ),
            'removeArticlesResult',
            $this->hydratorConfigFactory->createMailingArticleConfig()
        );
    }

    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->rename(['resource_id' => $id, 'name' => $title]),
            'renameResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param int[] $profileIds
     *
     * @return int[]
     * @throws EmptyResultException
     */
    public function sendToProfiles(int $id, array $profileIds): array
    {
        return $this->responseMapper->getArray(
            $this->soapClient->sendToProfiles(
                [
                    'mailing_id' => $id,
                    'profile_ids' => $profileIds,
                ]
            ),
            'sendToProfilesResult'
        );
    }

    /**
     * @param int $id
     * @param int $targetGroupId
     * @param int $sendTime
     * @param int $speed
     *
     * @return MailingDetailInterface
     * @throws EmptyResultException
     */
    public function sendToTargetGroup(int $id, int $targetGroupId, int $sendTime, int $speed): MailingDetailInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->sendToTargetgroup(
                [
                    'mailing_id' => $id,
                    'targetgroup_id' => $targetGroupId,
                    'send_time' => $sendTime,
                    'speed' => $speed,
                ]
            ),
            'sendToTargetgroupResult',
            $this->hydratorConfigFactory->createMailingDetailConfig()
        );
    }

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
    ): MailingConfigurationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setConfiguration(
                [
                    'mailing_id' => $id,
                    'configuration' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createMailingConfigurationConfig(),
                        $configuration
                    ),
                ]
            ),
            'setConfigurationResult',
            $this->hydratorConfigFactory->createMailingConfigurationConfig()
        );
    }

    /**
     * @param string $id
     * @param int $cursor
     *
     * @return bool
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
     * @param int $id
     * @param string[] $subjects
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function setSubjects(int $id, array $subjects): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->setSubjects(
                [
                    'mailing_id' => $id,
                    'subjects' => ['item' => $subjects],
                ]
            ),
            'setSubjectsResult'
        );
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function delete(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->delete(['resource_id' => $id]),
            'deleteResult'
        );
    }

    /**
     * @param int $id
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function copy(int $id, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->copy(['resource_id' => $id, 'category_id' => $folderId]),
            'copyResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getListByMandatorId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAll(['mandator_id' => $id]),
            'getAllResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByFolderId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByCategory(['category_id' => $id]),
            'getByCategoryResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getById(int $id): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getById(['resource_id' => $id]),
            'getByIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return FolderInformationInterface
     * @throws EmptyResultException
     */
    public function getDefaultFolderByMandatorId(int $id): FolderInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getResourceDefaultCategory(['customer_id' => $id]),
            'getResourceDefaultCategoryResult',
            $this->hydratorConfigFactory->createFolderInformationConfig()
        );
    }

    /**
     * @param string $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getByExternalId(string $id): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getByExternalId(['external_id' => $id]),
            'getByExternalIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
