<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;
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
use stdClass;

class MailingClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;

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

    public function setUp(): void
    {
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ClientStatisticInterface::class);

        $response = new stdClass();
        $response->getClientStatisticsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createClientStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getClientStatistics',
                [[
                    'mailing_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getClientStatisticsResult',
            $config
        )->willReturn($response->getClientStatisticsResult);

        self::assertInstanceOf(
            ClientStatisticInterface::class,
            $this->subject->getClientStatisticById($id)
        );
    }

    public function testGetStatisticsByMailingIdCanReturnInstanceOfMailingStatistic()
    {
        $id = 1234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingStatisticInterface::class);

        $response = new stdClass();
        $response->getStatisticsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getStatistics',
                [[
                    'mailing_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getStatisticsResult',
            $config
        )->willReturn($response->getStatisticsResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingStatusInterface::class);
        $otherObject = $this->createStub(MailingStatusInterface::class);

        $response = new stdClass();
        $response->getStatusResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getStatus',
                [[
                    'mailing_id' => $id,
                    'timeframe' => $timeFrame,
                    'profile_attributes' => $profileAttributes,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getStatusResult',
            $config
        )->willReturn($response->getStatusResult);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingImpressionInterface::class);
        $otherObject = $this->createStub(MailingImpressionInterface::class);

        $response = new stdClass();
        $response->getImpressionsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingImpressionConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getImpressions',
                [[
                    'mailing_id' => $id,
                    'start_timestamp' => $timestampStart,
                    'end_timestamp' => $timestampEnd,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getImpressionsResult',
            $config
        )->willReturn($response->getImpressionsResult);

        $this->assertContainsOnlyInstancesOf(
            MailingImpressionInterface::class,
            $this->subject->getImpressions($id, $timestampStart, $timestampEnd)
        );
    }

    public function testGetServiceAvailableCanReturnInstanceOfServiceStatus()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ServiceStatusInterface::class);

        $response = new stdClass();
        $response->isAliveResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createServiceStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with('isAlive', [])
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'isAliveResult',
            $config
        )->willReturn($response->isAliveResult);

        self::assertInstanceOf(
            ServiceStatusInterface::class,
            $this->subject->getServiceAvailable()
        );
    }

    public function testSetConfigurationCanReturnInstanceOfMailingConfiguration()
    {
        $id = 123;
        $configuration = $this->createStub(MailingConfigurationInterface::class);

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingConfigurationInterface::class);

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new stdClass();
        $response->setConfigurationResult = $object;

        $this->extractor->expects($this->once())->method('extract')->with($config, $configuration)->willReturn($extractedData);
        $this->hydratorConfigFactory->expects($this->exactly(2))->method('createMailingConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'setConfiguration',
                [[
                    'mailing_id' => $id,
                    'configuration' => $extractedData,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'setConfigurationResult',
            $config
        )->willReturn($response->setConfigurationResult);

        self::assertInstanceOf(
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

        $response = new stdClass();
        $response->setSubjectsResult = true;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'setSubjects',
                [[
                    'mailing_id' => $id,
                    'subjects' => ['item' => $subjects],
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'setSubjectsResult'
        )->willReturn($response->setSubjectsResult);

        $this->assertTrue($this->subject->setSubjects($id, $subjects));
    }

    public function testGetByTypeIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;
        $mandatorId = 76;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingDetailInterface::class);

        $response = new stdClass();
        $response->getByTypeIdResult = [
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getByTypeId',
                [[
                    'type_id' => $id,
                    'mandator_id' => $mandatorId
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getByTypeIdResult',
            $config
        )->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            MailingDetailInterface::class,
            $this->subject->getByTypeId($id, $mandatorId)
        );
    }

    public function testGetSendableDraftsCanReturnArrayOfResourceInformation()
    {
        $unSent = true;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $otherObject = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->getSendableDraftsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getSendableDrafts',
                [[
                    'unsent' => $unSent,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getSendableDraftsResult',
            $config
        )->willReturn($response->getSendableDraftsResult);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingDetailInterface::class);

        $response = new stdClass();
        $response->sendToTargetgroupResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'sendToTargetgroup',
                [[
                    'mailing_id' => $id,
                    'targetgroup_id' => $targetGroupId,
                    'send_time' => $sendTime,
                    'speed' => $speed,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'sendToTargetgroupResult',
            $config
        )->willReturn($response->sendToTargetgroupResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getAllArticleImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getAllArticleImpressionProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getAllArticleImpressionProfilesResult',
            $config
        )->willReturn($response->getAllArticleImpressionProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getAllArticleImpressionProfiles($id, $attributeTitles)
        );
    }

    public function testGetConfigurationCanReturnInstanceOfMailingConfiguration()
    {
        $id = 1234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingConfigurationInterface::class);

        $response = new stdClass();
        $response->getConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getConfiguration',
                [[
                    'mailing_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getConfigurationResult',
            $config
        )->willReturn($response->getConfigurationResult);

        self::assertInstanceOf(
            MailingConfigurationInterface::class,
            $this->subject->getConfiguration($id)
        );
    }

    public function testGetBounceProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getBounceProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getBounceProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getBounceProfilesResult',
            $config
        )->willReturn($response->getBounceProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getBounceProfiles($id, $attributeTitles)
        );
    }

    public function testGetSubjectsByMailingIdCanReturnArrayOfMailingSubject()
    {
        $id = 1234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingSubjectInterface::class);
        $otherObject = $this->createStub(MailingSubjectInterface::class);

        $response = new stdClass();
        $response->getSubjectsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingSubjectConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getSubjects',
                [[
                    'mailing_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getSubjectsResult',
            $config
        )->willReturn($response->getSubjectsResult);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingArticleInterface::class);
        $otherObject = $this->createStub(MailingArticleInterface::class);

        $response = new stdClass();
        $response->removeArticlesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingArticleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'removeArticles',
                [[
                    'mailing_id' => $id,
                    'reference_ids' => $referenceIds,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'removeArticlesResult',
            $config
        )->willReturn($response->removeArticlesResult);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getLinkClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getLinkClickProfiles',
                [[
                    'mailing_id' => $id,
                    'link_id' => $linkId,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getLinkClickProfilesResult',
            $config
        )->willReturn($response->getLinkClickProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getLinkClickProfiles($id, $linkId, $attributeTitles)
        );
    }

    public function testGetArticlesByMailingIdCanReturnArrayOfMailingArticle()
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingArticleInterface::class);
        $otherObject = $this->createStub(MailingArticleInterface::class);

        $response = new stdClass();
        $response->getArticlesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingArticleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getArticles',
                [[
                    'mailing_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getArticlesResult',
            $config
        )->willReturn($response->getArticlesResult);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getClickProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getClickProfilesResult',
            $config
        )->willReturn($response->getClickProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getClickProfiles($id, $attributeTitles)
        );
    }

    public function testGetArticleStatisticsCanReturnArrayOfArticleStatistic()
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ArticleStatisticInterface::class);
        $otherObject = $this->createStub(ArticleStatisticInterface::class);

        $response = new stdClass();
        $response->getArticleStatisticsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createArticleStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getArticleStatistics',
                [[
                    'mailing_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getArticleStatisticsResult',
            $config
        )->willReturn($response->getArticleStatisticsResult);

        $this->assertContainsOnlyInstancesOf(
            ArticleStatisticInterface::class,
            $this->subject->getArticleStatistics($id)
        );
    }

    public function testGetSendableDraftsByMandatorIdCanReturnArrayOfResourceInformation()
    {
        $id = 1234;
        $unSent = true;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $otherObject = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->getSendableDraftsByMandatorIdResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getSendableDraftsByMandatorId',
                [[
                    'mandator_id' => $id,
                    'unsent' => $unSent,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getSendableDraftsByMandatorIdResult',
            $config
        )->willReturn($response->getSendableDraftsByMandatorIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getSendableDraftsByMandatorId($id, $unSent)
        );
    }

    public function testRemoveAllArticlesCanReturnBoolean()
    {
        $id = 123;

        $response = new stdClass();
        $response->removeAllArticlesResult = true;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'removeAllArticles',
                [[
                    'mailing_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->willReturn($response->removeAllArticlesResult);

        $this->assertTrue($this->subject->removeAllArticles($id));
    }

    public function testCreateDraft()
    {
        $title = 'some title';
        $templateId = 32;
        $folderId = 23;
        $typeId = 234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->createDraftResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn(
            $config
        );
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'createDraft',
                [[
                    'name' => $title,
                    'template_id' => $templateId,
                    'category_id' => $folderId,
                    'type_id' => $typeId
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createDraftResult',
            $config
        )->willReturn($response->createDraftResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->createDraft($title, $templateId, $folderId, $typeId)
        );
    }

    public function testGetSoftbounceProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getSoftbounceProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getSoftbounceProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getSoftbounceProfilesResult',
            $config
        )->willReturn($response->getSoftbounceProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getSoftbounceProfiles($id, $attributeTitles)
        );
    }

    public function testSetResultCursorCanReturnBoolean()
    {
        $id = 'some Id';
        $cursor = 5;

        $response = new stdClass();
        $response->setResultCursorResult = false;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'setResultCursor',
                [[
                    'job_id' => $id,
                    'cursor' => $cursor,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'setResultCursorResult'
        )->willReturn($response->setResultCursorResult);

        $this->assertFalse($this->subject->setResultCursor($id, $cursor));
    }

    public function testGetImpressionProfilesCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $attributeTitles = [
            'some',
            'data',
        ];

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getImpressionProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getImpressionProfilesResult',
            $config
        )->willReturn($response->getImpressionProfilesResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getRecipientsProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getRecipientsProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getRecipientsProfilesResult',
            $config
        )->willReturn($response->getRecipientsProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getRecipientsProfiles($id, $attributeTitles)
        );
    }

    public function testGetResultsCanReturnInstanceOfJobResult()
    {
        $id = '123';

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobResultInterface::class);

        $response = new stdClass();
        $response->getResultsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobResultConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getResults',
                [[
                    'job_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getResultsResult',
            $config
        )->willReturn($response->getResultsResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getMultipleImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getMultipleImpressionProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getMultipleImpressionProfilesResult',
            $config
        )->willReturn($response->getMultipleImpressionProfilesResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getAllLinkClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getAllLinkClickProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getAllLinkClickProfilesResult',
            $config
        )->willReturn($response->getAllLinkClickProfilesResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getAllLinkClickProfiles($id, $attributeTitles)
        );
    }

    public function testAddArticles()
    {
        $id = 1234;
        $articles = [
            $this->createStub(MailingArticleInterface::class),
            $this->createStub(MailingArticleInterface::class)
        ];

        $config = $this->createStub(HydratorConfigInterface::class);

        $response = new stdClass();
        $response->addArticlesResult = $articles;

        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $this->extractor->expects($this->once())->method('extractArray')->with(
            $config,
            $articles
        )->willReturn($extractedData);
        $this->hydratorConfigFactory->expects($this->exactly(2))->method('createMailingArticleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'addArticles',
                [[
                    'mailing_id' => $id,
                    'articles' => $extractedData
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'addArticlesResult',
            $config
        )->willReturn($response->addArticlesResult);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getHardbounceProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getHardbounceProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getHardbounceProfilesResult',
            $config
        )->willReturn($response->getHardbounceProfilesResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getMultipleClickProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getMultipleClickProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getMultipleClickProfilesResult',
            $config
        )->willReturn($response->getMultipleClickProfilesResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getArticleImpressionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getArticleImpressionProfiles',
                [[
                    'mailing_id' => $id,
                    'article_id' => $article_id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getArticleImpressionProfilesResult',
            $config
        )->willReturn($response->getArticleImpressionProfilesResult);

        self::assertInstanceOf(
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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getUnsubscriptionProfilesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getUnsubscriptionProfiles',
                [[
                    'mailing_id' => $id,
                    'attribute_names' => $attributeTitles,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getUnsubscriptionProfilesResult',
            $config
        )->willReturn($response->getUnsubscriptionProfilesResult);

        self::assertInstanceOf(
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

        $response = new stdClass();
        $response->sendToProfilesResult = $profileIds;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'sendToProfiles',
                [[
                    'mailing_id' => $id,
                    'profile_ids' => $profileIds,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getArray')->with(
            $response,
            'sendToProfilesResult'
        )->willReturn($response->sendToProfilesResult);

        self::assertSame(
            $profileIds,
            $this->subject->sendToProfiles($id, $profileIds)
        );
    }

    public function testGetDetailsByIdCanReturnIsntanceOfMailingDetail()
    {
        $id = 1234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingDetailInterface::class);

        $response = new stdClass();
        $response->getDetailsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingDetailConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getDetails',
                [[
                    'mailing_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDetailsResult',
            $config
        )->willReturn($response->getDetailsResult);

        self::assertInstanceOf(
            MailingDetailInterface::class,
            $this->subject->getDetailsById($id)
        );
    }

    public function testGetJobInformationCanReturnInstanceOfJobHandle()
    {
        $id = '123';

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(JobHandleInterface::class);

        $response = new stdClass();
        $response->getJobInformationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getJobInformation',
                [[
                    'job_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getJobInformationResult',
            $config
        )->willReturn($response->getJobInformationResult);

        self::assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getJobInformation($id)
        );
    }

    public function testGetResultCursor()
    {
        $id = '234';

        $response = new stdClass();
        $response->getResultCursorResult = 'some return string';

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getResultCursor',
                [[
                    'job_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getString')->with(
            $response,
            'getResultCursorResult'
        )->willReturn($response->getResultCursorResult);

        self::assertSame(
            'some return string',
            $this->subject->getResultCursorByJobId($id)
        );
    }

    public function testUpdateTitleCanReturnInstanceOfResourceInformationInterface()
    {
        $id = 123;
        $title = 'some title';

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->renameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'rename',
                [[
                    'resource_id' => $id,
                    'name' => $title,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'renameResult',
            $config
        )->willReturn($response->renameResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->updateTitle($id, $title)
        );
    }

    public function testGetClicksCanReturnInstanceOfMailingClick()
    {
        $id = 123;
        $timestampStart = 123123123;
        $timestampEnd = 234234234;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MailingClickInterface::class);
        $otherObject = $this->createStub(MailingClickInterface::class);

        $response = new stdClass();
        $response->getClicksResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingClickConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getClicks',
                [[
                    'mailing_id' => $id,
                    'start_timestamp' => $timestampStart,
                    'end_timestamp' => $timestampEnd,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getClicksResult',
            $config
        )->willReturn($response->getClicksResult);

        $this->assertContainsOnlyInstancesOf(
            MailingClickInterface::class,
            $this->subject->getClicks($id, $timestampStart, $timestampEnd)
        );
    }

    public function testGetTypeIdsCanReturnArrayOfResourceInformation()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceTypeInformationInterface::class);
        $otherObject = $this->createStub(ResourceTypeInformationInterface::class);

        $response = new stdClass();
        $response->getByTypeIdResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceTypeInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with('getTypeIds', [])
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getTypeIdsResult',
            $config
        )->willReturn($response->getByTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceTypeInformationInterface::class,
            $this->subject->getTypeIds()
        );
    }

    public function testGetByFolderIdCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $otherObject = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->getByCategoryResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getByCategory',
                [[
                    'category_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getByCategoryResult',
            $config
        )->willReturn($response->getByCategoryResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByFolderId($id)
        );
    }

    public function testGetByIdCanReturnInstanceOfResourceInformation()
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getById',
                [[
                    'resource_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getByIdResult',
            $config
        )->willReturn($response->getByExternalIdResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getById($id)
        );
    }

    public function testGetDefaultFolderByMandatorIdCanReturnInstanceOfFolderInformation()
    {
        $id = 456;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(FolderInformationInterface::class);

        $response = new stdClass();
        $response->getResourceDefaultCategoryResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getResourceDefaultCategory',
                [[
                    'customer_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getResourceDefaultCategoryResult',
            $config
        )->willReturn($response->getResourceDefaultCategoryResult);

        self::assertInstanceOf(
            FolderInformationInterface::class,
            $this->subject->getDefaultFolderByMandatorId($id)
        );
    }

    public function testGetByExternalIdCanReturnInstanceOfResourceInformation()
    {
        $id = 'some id';

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->getByExternalIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getByExternalId',
                [[
                    'external_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getByExternalIdResult',
            $config
        )->willReturn($response->getByExternalIdResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getByExternalId($id)
        );
    }

    public function testGetContentContainerDataReturnsData(): void
    {
        $id = 666;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(HashMapInterface::class);

        $response = new stdClass();
        $response->getContentContainerDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createHashMapConfig')
            ->willReturn($config);
        
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getContentContainerData',
                [[
                    'resource_id' => $id
                ]]
            )
            ->willReturn($response);
        
        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getContentContainerDataResult',
                $config
            )
            ->willReturn($response->getContentContainerDataResult);

        self::assertSame(
            $object,
            $this->subject->getContentContainerData($id)
        );
    }

    public function testSetContentContainerDataSetsData(): void
    {
        $id = 666;
        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $hashMapConfig = $this->createStub(HydratorConfigInterface::class);
        $resourceInformationConfig = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $hashMap = $this->createStub(HashMapInterface::class);

        $response = new stdClass();
        $response->setContentContainerDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createHashMapConfig')
            ->willReturn($hashMapConfig);
        $this->hydratorConfigFactory->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($resourceInformationConfig);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'setContentContainerData',
                [[
                    'resource_id' => $id,
                    'data' => $extractedData
                ]]
            )
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'setContentContainerDataResult',
                $resourceInformationConfig
            )
            ->willReturn($response->setContentContainerDataResult);

        $this->extractor->expects($this->once())
            ->method('extract')
            ->with(
                $hashMapConfig,
                $hashMap
            )
            ->willReturn($extractedData);

        self::assertSame(
            $object,
            $this->subject->setContentContainerData($id, $hashMap)
        );
    }

    public function testUpdateModuleTypesCanReturnBool(): void
    {
        $id = 23;
        $moduleTypeContent = 'some-thing';

        $response = new stdClass();
        $response->updateModuleTypesResult = true;

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'updateModuleTypes',
                [[
                    'resource_id' => $id,
                    'module_type_content' => $moduleTypeContent
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'updateModuleTypesResult'
        )->willReturn($response->updateModuleTypesResult);


        self::assertTrue($this->subject->updateModuleTypes($id, $moduleTypeContent));
    }

    public function testGetModuleTypesCanReturnString(): void
    {
        $id = 23;

        $response = new stdClass();
        $response->retrieveModuleTypesResult = 'some-thing';

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'retrieveModuleTypes',
                [[
                    'resource_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getString')->with(
            $response,
            'retrieveModuleTypesResult'
        )->willReturn($response->retrieveModuleTypesResult);


        self::assertSame('some-thing', $this->subject->getModuleTypes($id));
    }

    public function testRunContentGenerationReturnsData(): void
    {
        $id = 666;
        $extractedData = ['some' => 'data'];

        $hashMapConfig = $this->createStub(HydratorConfigInterface::class);
        $hydrator = $this->createStub(HydratorConfigInterface::class);
        $result = $this->createStub(JobStateInterface::class);
        $variables = $this->createStub(HashMapInterface::class);

        $response = new stdClass();
        $response->runContentGenerationResult = $result;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createHashMapConfig')
            ->willReturn($hashMapConfig);
        $this->hydratorConfigFactory->expects($this->once())
            ->method('createJobStateConfig')
            ->willReturn($hydrator);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'runContentGeneration',
                [[
                    'resource_id' => $id,
                    'variables' => $extractedData
                ]]
            )
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'runContentGenerationResult',
                $hydrator
            )
            ->willReturn($response->runContentGenerationResult);

        $this->extractor->expects($this->once())
            ->method('extract')
            ->with(
                $hashMapConfig,
                $variables
            )
            ->willReturn($extractedData);

        self::assertSame(
            $result,
            $this->subject->runContentGeneration($id, $variables)
        );
    }

    public function testGetJobStateReturnsData(): void
    {
        $id = 'some-id';

        $hydrator = $this->createStub(HydratorConfigInterface::class);
        $result = $this->createStub(JobStateInterface::class);

        $response = new stdClass();
        $response->getJobStateResult = $result;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createJobStateConfig')
            ->willReturn($hydrator);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getJobState',
                [[
                    'job_id' => $id,
                ]]
            )
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getJobStateResult',
                $hydrator
            )
            ->willReturn($response->getJobStateResult);

        self::assertSame(
            $result,
            $this->subject->getJobState($id)
        );
    }

    public function testGetContentGenerationVariablesReturnsData(): void
    {
        $id = 666;

        $hydrator = $this->createStub(HydratorConfigInterface::class);
        $result = $this->createStub(JobStateInterface::class);

        $response = new stdClass();
        $response->getContentGenerationVariablesResult = $result;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createContentGenerationVariableConfig')
            ->willReturn($hydrator);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getContentGenerationVariables',
                [[
                    'resource_id' => $id,
                ]]
            )
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'getContentGenerationVariablesResult',
                $hydrator
            )
            ->willReturn([$result]);

        self::assertSame(
            [$result],
            $this->subject->getContentGenerationVariables($id)
        );
    }
}
