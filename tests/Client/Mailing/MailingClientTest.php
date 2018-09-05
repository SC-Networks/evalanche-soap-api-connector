<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
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
 * Class MailingClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
class MailingClientTest extends TestCase
{
    /**
     * @var MailingClient
     */
    private $subject;

    /**
     * @var EvalancheSoapClient|MockObject
     */
    private $soapClient;

    /**
     * @var ResponseMapperInterface|MockObject
     */
    private $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface|MockObject
     */
    private $hydratorConfigFactory;

    /**
     * @var ExtractorInterface|MockObject
     */
    private $extractor;

    public function setUp()
    {
        $this->soapClient = $this->getWsdlMock([
            'addArticles',
            'getClientStatistics',
            'createDraft',
            'getAllArticleImpressionProfiles',
            'getAllLinkClickProfiles',
            'getArticleStatistics',
            'getBounceProfiles',
            'getByTypeId',
            'getClickProfiles',
            'getClicks',
            'getConfiguration',
            'getDetails',
            'getHardbounceProfiles',
            'getImpressionProfiles',
            'getImpressions',
            'getJobInformation',
            'getLinkClickProfiles',
            'getMultipleClickProfiles',
            'getMultipleImpressionProfiles',
            'getRecipientsProfiles',
            'getResultCursor',
            'getResults',
            'getSendableDrafts',
            'getSendableDraftsByMandatorId',
            'getSoftbounceProfiles',
            'getStatistics',
            'getStatus',
            'getSubjects',
            'getTypeIds',
            'getUnsubscriptionProfiles',
            'isAlive',
            'move',
            'removeAllArticles',
            'removeArticles',
            'rename',
            'sendToProfiles',
            'sendToTargetgroup',
            'setConfiguration',
            'setResultCursor',
            'setSubjects',
            'getArticleImpressionProfiles',
            'getArticles',
            'delete',
            'copy',
            'getAll',
            'getByCategory',
            'getById',
            'getResourceDefaultCategory',
            'getByExternalId',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new MailingClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetClientStatisticByIdCanReturnInstanceOfClientStatistic()
    {
        $id = 2234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ClientStatisticInterface::class)->getMock();

        $response = new \stdClass();
        $response->getClientStatisticsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createClientStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getClientStatistics')->with(['mailing_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getClientStatisticsResult',
            $config)->willReturn($response->getClientStatisticsResult);

        $this->assertInstanceOf(
            ClientStatisticInterface::class,
            $this->subject->getClientStatisticById($id)
        );
    }

    public function testGetStatisticsByMailingIdCanReturnInstanceOfMailingStatistic()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingStatisticInterface::class)->getMock();

        $response = new \stdClass();
        $response->getStatisticsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getStatistics')->with([
            'mailing_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getStatisticsResult',
            $config)->willReturn($response->getStatisticsResult);

        $this->assertInstanceOf(
            MailingStatisticInterface::class,
            $this->subject->getStatisticsByMailingId($id)
        );
    }

    public function testGetStatusCanReturnArrayOfMailingStatus()
    {
        $id = 123;
        $timeFrame = 123123123;
        $profileAttributes = [
            'some',
            'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingStatusInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingStatusInterface::class)->getMock();

        $response = new \stdClass();
        $response->getStatusResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getStatus')->with([
            'mailing_id' => $id,
            'timeframe' => $timeFrame,
            'profile_attributes' => $profileAttributes,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getStatusResult',
            $config)->willReturn($response->getStatusResult);

        $this->assertContainsOnlyInstancesOf(
            MailingStatusInterface::class,
            $this->subject->getStatus($id, $timeFrame, $profileAttributes)
        );
    }

    public function testGetImpressionsCanReturnArrayOfMailingImpression()
    {
        $id = 123;
        $timestampStart = 123123123;
        $timestampEnd = 12312313213;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingImpressionInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingImpressionInterface::class)->getMock();

        $response = new \stdClass();
        $response->getImpressionsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingImpressionConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getImpressions')->with([
            'mailing_id' => $id,
            'start_timestamp' => $timestampStart,
            'end_timestamp' => $timestampEnd,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getImpressionsResult',
            $config)->willReturn($response->getImpressionsResult);

        $this->assertContainsOnlyInstancesOf(
            MailingImpressionInterface::class,
            $this->subject->getImpressions($id, $timestampStart, $timestampEnd)
        );
    }

    public function testGetServiceAvailableCanReturnInstanceOfServiceStatus()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ServiceStatusInterface::class)->getMock();

        $response = new \stdClass();
        $response->isAliveResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createServiceStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('isAlive')->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'isAliveResult',
            $config)->willReturn($response->isAliveResult);

        $this->assertInstanceOf(
            ServiceStatusInterface::class,
            $this->subject->getServiceAvailable()
        );
    }

    public function testSetConfigurationCanReturnInstanceOfMailingConfiguration()
    {
        $id = 123;
        $configuration = $this->getMockBuilder(MailingConfigurationInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingConfigurationInterface::class)->getMock();

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new \stdClass();
        $response->setConfigurationResult = $object;

        $this->extractor->expects($this->once())->method('extract')->with($config, $configuration)->willReturn($extractedData);
        $this->hydratorConfigFactory->expects($this->exactly(2))->method('createMailingConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('setConfiguration')->with([
            'mailing_id' => $id,
            'configuration' => $extractedData,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'setConfigurationResult',
            $config)->willReturn($response->setConfigurationResult);

        $this->assertInstanceOf(
            MailingConfigurationInterface::class,
            $this->subject->setConfiguration($id, $configuration)
        );
    }

    public function testSetSubjectsCanReturnBoolean()
    {
        $id = 123;
        $subjects = [
            'some subject',
            'some other subject'
        ];

        $response = new \stdClass();
        $response->setSubjectsResult = true;

        $this->soapClient->expects($this->once())->method('setSubjects')->with([
            'mailing_id' => $id,
            'subjects' => ['item' => $subjects],
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'setSubjectsResult')->willReturn($response->setSubjectsResult);

        $this->assertTrue($this->subject->setSubjects($id, $subjects));
    }

    public function testGetByTypeIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;
        $mandatorId = 76;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingDetailInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByTypeIdResult = [
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByTypeId')->with([
            'type_id' => $id,
            'mandator_id' => $mandatorId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getByTypeIdResult',
            $config)->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            MailingDetailInterface::class,
            $this->subject->getByTypeId($id, $mandatorId)
        );
    }

    public function testGetSendableDraftsCanReturnArrayOfResourceInformation()
    {
        $unSent = true;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getSendableDraftsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getSendableDrafts')->with([
            'unsent' => $unSent,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getSendableDraftsResult',
            $config)->willReturn($response->getSendableDraftsResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getSendableDrafts($unSent)
        );
    }

    public function testSendToTargetGroupCanReturnInstanceOfMailingDetail()
    {
        $id = 123;
        $targetGroupId = 123123123;
        $sendTime = 234234234;
        $speed = 234234234232342;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingDetailInterface::class)->getMock();

        $response = new \stdClass();
        $response->sendToTargetgroupResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('sendToTargetgroup')->with([
            'mailing_id' => $id,
            'targetgroup_id' => $targetGroupId,
            'send_time' => $sendTime,
            'speed' => $speed,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'sendToTargetgroupResult',
            $config)->willReturn($response->sendToTargetgroupResult);

        $this->assertInstanceOf(
            MailingDetailInterface::class,
            $this->subject->sendToTargetGroup($id, $targetGroupId, $sendTime, $speed)
        );
    }

    public function testGetAllArticleImpressionProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAllArticleImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAllArticleImpressionProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getAllArticleImpressionProfilesResult',
            $config)->willReturn($response->getAllArticleImpressionProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getAllArticleImpressionProfiles($id, $attributeTitles)
        );
    }

    public function testGetConfigurationCanReturnInstanceOfMailingConfiguration()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingConfigurationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getConfiguration')->with([
            'mailing_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getConfigurationResult',
            $config)->willReturn($response->getConfigurationResult);

        $this->assertInstanceOf(
            MailingConfigurationInterface::class,
            $this->subject->getConfiguration($id)
        );
    }

    public function testMoveCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $folderId = 34;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->moveResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('move')->with([
            'resource_id' => $id,
            'category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'moveResult',
            $config)->willReturn($response->moveResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->move($id, $folderId)
        );
    }

    public function testGetBounceProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getBounceProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getBounceProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getBounceProfilesResult',
            $config)->willReturn($response->getBounceProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getBounceProfiles($id, $attributeTitles)
        );
    }

    public function testGetSubjectsByMailingIdCanReturnArrayOfMailingSubject()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingSubjectInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingSubjectInterface::class)->getMock();

        $response = new \stdClass();
        $response->getSubjectsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingSubjectConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getSubjects')->with([
            'mailing_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getSubjectsResult',
            $config)->willReturn($response->getSubjectsResult);

        $this->assertContainsOnlyInstancesOf(
            MailingSubjectInterface::class,
            $this->subject->getSubjectsByMailingId($id)
        );
    }

    public function testRemoveArticlesCanReturnArrayOfMailingArticle()
    {
        $id = 1234;
        $referenceIds = [
            1,
            2,
            3,
            4
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingArticleInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingArticleInterface::class)->getMock();

        $response = new \stdClass();
        $response->removeArticlesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingArticleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('removeArticles')->with([
            'mailing_id' => $id,
            'reference_ids' => $referenceIds,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'removeArticlesResult',
            $config)->willReturn($response->removeArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            MailingArticleInterface::class,
            $this->subject->removeArticles($id, $referenceIds)
        );
    }

    public function testGetLinkClickProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $linkId = 445;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getLinkClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getLinkClickProfiles')->with([
            'mailing_id' => $id,
            'link_id' => $linkId,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getLinkClickProfilesResult',
            $config)->willReturn($response->getLinkClickProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getLinkClickProfiles($id, $linkId, $attributeTitles)
        );
    }

    public function testGetArticlesByMailingIdCanReturnArrayOfMailingArticle()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingArticleInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingArticleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getArticlesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingArticleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getArticles')->with([
            'mailing_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getArticlesResult',
            $config)->willReturn($response->getArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            MailingArticleInterface::class,
            $this->subject->getArticlesByMailingId($id)
        );
    }

    public function testGetClickProfiles()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getClickProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getClickProfilesResult',
            $config)->willReturn($response->getClickProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getClickProfiles($id, $attributeTitles)
        );
    }

    public function testGetArticleStatisticsCanReturnArrayOfArticleStatistic()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ArticleStatisticInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ArticleStatisticInterface::class)->getMock();

        $response = new \stdClass();
        $response->getArticleStatisticsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createArticleStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getArticleStatistics')->with([
            'mailing_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getArticleStatisticsResult',
            $config)->willReturn($response->getArticleStatisticsResult);

        $this->assertContainsOnlyInstancesOf(
            ArticleStatisticInterface::class,
            $this->subject->getArticleStatistics($id)
        );
    }

    public function testGetSendableDraftsByMandatorIdCanReturnArrayOfResourceInformation()
    {
        $id = 1234;
        $unSent = true;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getSendableDraftsByMandatorIdResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getSendableDraftsByMandatorId')->with([
            'mandator_id' => $id,
            'unsent' => $unSent,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getSendableDraftsByMandatorIdResult',
            $config)->willReturn($response->getSendableDraftsByMandatorIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getSendableDraftsByMandatorId($id, $unSent)
        );
    }

    public function testRemoveAllArticlesCanReturnBoolean()
    {
        $id = 123;

        $response = new \stdClass();
        $response->removeAllArticlesResult = true;

        $this->soapClient->expects($this->once())->method('removeAllArticles')->with(['mailing_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->willReturn($response->removeAllArticlesResult);

        $this->assertTrue($this->subject->removeAllArticles($id));
    }

    public function testCreateDraft()
    {
        $title = 'some title';
        $templateId = 32;
        $folderId = 23;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->createDraftResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('createDraft')->with([
            'name' => $title,
            'template_id' => $templateId,
            'category_id' => $folderId,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'createDraftResult',
            $config)->willReturn($response->createDraftResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->createDraft($title, $templateId, $folderId)
        );
    }

    public function testGetSoftbounceProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getSoftbounceProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getSoftbounceProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getSoftbounceProfilesResult',
            $config)->willReturn($response->getSoftbounceProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getSoftbounceProfiles($id, $attributeTitles)
        );
    }

    public function testSetResultCursorCanReturnBoolean()
    {
        $id = 'some Id';
        $cursor = 5;

        $response = new \stdClass();
        $response->setResultCursorResult = false;

        $this->soapClient->expects($this->once())->method('setResultCursor')->with(
            [
                'job_id' => $id,
                'cursor' => $cursor,
            ]
        )->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'setResultCursorResult')->willReturn($response->setResultCursorResult);

        $this->assertFalse($this->subject->setResultCursor($id, $cursor));
    }

    public function testGetImpressionProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getImpressionProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getImpressionProfilesResult',
            $config)->willReturn($response->getImpressionProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getImpressionProfiles($id, $attributeTitles)
        );
    }

    public function testGetRecipientsProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getRecipientsProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getRecipientsProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getRecipientsProfilesResult',
            $config)->willReturn($response->getRecipientsProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getRecipientsProfiles($id, $attributeTitles)
        );
    }

    public function testGetResultsCanReturnInstanceOfJobResult()
    {
        $id = '123';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobResultInterface::class)->getMock();

        $response = new \stdClass();
        $response->getResultsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobResultConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getResults')->with([
            'job_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getResultsResult',
            $config)->willReturn($response->getResultsResult);

        $this->assertInstanceOf(
            JobResultInterface::class,
            $this->subject->getResults($id)
        );
    }

    public function testGetMultipleImpressionProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getMultipleImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getMultipleImpressionProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getMultipleImpressionProfilesResult',
            $config)->willReturn($response->getMultipleImpressionProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getMultipleImpressionProfiles($id, $attributeTitles)
        );
    }

    public function testGetAllLinkClickProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAllLinkClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAllLinkClickProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getAllLinkClickProfilesResult',
            $config)->willReturn($response->getAllLinkClickProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getAllLinkClickProfiles($id, $attributeTitles)
        );
    }

    public function testAddArticles()
    {
        $id = 1234;
        $articles = [
            $this->getMockBuilder(MailingArticleInterface::class)->getMock(),
            $this->getMockBuilder(MailingArticleInterface::class)->getMock()
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $response = new \stdClass();
        $response->addArticlesResult = $articles;

        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $this->extractor->expects($this->once())->method('extractArray')->with($config,
            $articles)->willReturn($extractedData);
        $this->hydratorConfigFactory->expects($this->exactly(2))->method('createMailingArticleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('addArticles')->with([
            'mailing_id' => $id,
            'articles' => $extractedData
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'addArticlesResult',
            $config)->willReturn($response->addArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            MailingArticleInterface::class,
            $this->subject->addArticles($id, $articles)
        );
    }

    public function testGetHardbounceProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getHardbounceProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getHardbounceProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getHardbounceProfilesResult',
            $config)->willReturn($response->getHardbounceProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getHardbounceProfiles($id, $attributeTitles)
        );
    }

    public function testGetMultipleClickProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getMultipleClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getMultipleClickProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getMultipleClickProfilesResult',
            $config)->willReturn($response->getMultipleClickProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getMultipleClickProfiles($id, $attributeTitles)
        );
    }

    public function testGetArticleImpressionProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $article_id = 354;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getArticleImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getArticleImpressionProfiles')->with([
            'mailing_id' => $id,
            'article_id' => $article_id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getArticleImpressionProfilesResult',
            $config)->willReturn($response->getArticleImpressionProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getArticleImpressionProfiles($id, $article_id, $attributeTitles)
        );
    }

    public function testGetUnsubscriptionProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getUnsubscriptionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getUnsubscriptionProfiles')->with([
            'mailing_id' => $id,
            'attribute_names' => $attributeTitles,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getUnsubscriptionProfilesResult',
            $config)->willReturn($response->getUnsubscriptionProfilesResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getUnsubscriptionProfiles($id, $attributeTitles)
        );
    }

    public function testSendToProfiles()
    {
        $id = 1234;
        $profileIds = [
            1,
            2,
            4,
        ];

        $response = new \stdClass();
        $response->sendToProfilesResult = $profileIds;

        $this->soapClient->expects($this->once())->method('sendToProfiles')->with([
            'mailing_id' => $id,
            'profile_ids' => $profileIds,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getArray')->with($response,
            'sendToProfilesResult')->willReturn($response->sendToProfilesResult);

        $this->assertSame(
            $profileIds,
            $this->subject->sendToProfiles($id, $profileIds)
        );
    }

    public function testGetDetailsByIdCanReturnIsntanceOfMailingDetail()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingDetailInterface::class)->getMock();

        $response = new \stdClass();
        $response->getDetailsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getDetails')->with([
            'mailing_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getDetailsResult',
            $config)->willReturn($response->getDetailsResult);

        $this->assertInstanceOf(
            MailingDetailInterface::class,
            $this->subject->getDetailsById($id)
        );
    }

    public function testGetJobInformationCanReturnInstanceOfJobHandle()
    {
        $id = '123';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getJobInformationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getJobInformation')->with([
            'job_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getJobInformationResult',
            $config)->willReturn($response->getJobInformationResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getJobInformation($id)
        );
    }

    public function testGetResultCursor()
    {
        $id = '234';

        $response = new \stdClass();
        $response->getResultCursorResult = 'some return string';

        $this->soapClient->expects($this->once())->method('getResultCursor')->with(['job_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getString')->with($response,
            'getResultCursorResult')->willReturn($response->getResultCursorResult);

        $this->assertSame(
            'some return string',
            $this->subject->getResultCursorByJobId($id)
        );
    }

    public function testUpdateTitleCanReturnInstanceOfResourceInformationInterface()
    {
        $id = 123;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->renameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('rename')->with([
            'resource_id' => $id,
            'name' => $title,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'renameResult',
            $config)->willReturn($response->renameResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->updateTitle($id, $title)
        );
    }

    public function testGetClicksCanReturnInstanceOfMailingClick()
    {
        $id = 123;
        $timestampStart = 123123123;
        $timestampEnd = 234234234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingClickInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingClickInterface::class)->getMock();

        $response = new \stdClass();
        $response->getClicksResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingClickConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getClicks')->with([
            'mailing_id' => $id,
            'start_timestamp' => $timestampStart,
            'end_timestamp' => $timestampEnd,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getClicksResult',
            $config)->willReturn($response->getClicksResult);

        $this->assertContainsOnlyInstancesOf(
            MailingClickInterface::class,
            $this->subject->getClicks($id, $timestampStart, $timestampEnd)
        );
    }

    public function testGetTypeIdsCanReturnArrayOfResourceInformation()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByTypeIdResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceTypeInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getTypeIds')->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getTypeIdsResult',
            $config)->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceTypeInformationInterface::class,
            $this->subject->getTypeIds()
        );
    }

    public function testDeleteCanReturnBoolean()
    {
        $id = 56;

        $response = new \stdClass();
        $response->deleteResult = true;

        $this->soapClient->expects($this->once())->method('delete')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'deleteResult')->willReturn($response->deleteResult);

        $this->assertTrue($this->subject->delete($id));
    }

    public function testCopyCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $folderId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->copyResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('copy')->with([
            'resource_id' => $id,
            'category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'copyResult',
            $config)->willReturn($response->copyResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->copy($id, $folderId)
        );
    }

    public function testGetListByMandatorIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getAllResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAll')->with(['mandator_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getAllResult',
            $config)->willReturn($response->getAllResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getListByMandatorId($id)
        );
    }

    public function testGetByFolderIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByCategoryResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByCategory')->with(['category_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getByCategoryResult',
            $config)->willReturn($response->getByCategoryResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByFolderId($id)
        );
    }

    public function testGetByIdCanReturnInstanceOfResourceInformation()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getById')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getByIdResult',
            $config)->willReturn($response->getByExternalIdResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getById($id)
        );
    }

    public function testGetDefaultFolderByMandatorIdCanReturnInstanceOfFolderInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FolderInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getResourceDefaultCategoryResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getResourceDefaultCategory')->with(['customer_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getResourceDefaultCategoryResult',
            $config)->willReturn($response->getResourceDefaultCategoryResult);

        $this->assertInstanceOf(
            FolderInformationInterface::class,
            $this->subject->getDefaultFolderByMandatorId($id)
        );
    }

    public function testGetByExternalIdCanReturnInstanceOfResourceInformation()
    {
        $id = 'some id';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByExternalId')->with(['external_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getByExternalIdResult',
            $config)->willReturn($response->getByExternalIdResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getByExternalId($id)
        );
    }
}
