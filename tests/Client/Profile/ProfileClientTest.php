<?php

namespace Scn\EvalancheSoapApiConnector\Client\Profile;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistoryInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupMemberShipInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileActivityScoreInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatusInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileGroupScoreInterface;

/**
 * Class ProfileClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Profile
 */
class ProfileClientTest extends TestCase
{
    /**
     * @var ProfileClient
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
            'addScore',
            'create',
            'delete',
            'getActivityScoringHistory',
            'getBounces',
            'getById',
            'getByKey',
            'getByPool',
            'getByTargetGroup',
            'getGrantedPermissions',
            'getJobInformation',
            'getMailingStatus',
            'getModifiedProfiles',
            'getResultCursor',
            'getResults',
            'getScores',
            'getTypeIds',
            'getUnsubscriptions',
            'grantPermission',
            'isInTargetgroups',
            'massUpdate',
            'mergeById',
            'mergeByKey',
            'mergeByPool',
            'mergeByTargetGroup',
            'revokePermission',
            'revokeTracking',
            'setResultCursor',
            'tagWithOption',
            'untagWithOption',
            'updateById',
            'updateByKey',
            'updateByPool',
            'updateByTargetGroup',
            'getTrackingHistory'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new ProfileClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testAddScore()
    {
        $profileId = 123;
        $scoringGroupId = 45;
        $score = 12;
        $title = 'some title';

        $response = new \stdClass();
        $response->addScoreResult = true;

        $this->soapClient->expects($this->once())->method('addScore')->with([
            'profile_id' => $profileId,
            'scoring_group_id' => $scoringGroupId,
            'score' => $score,
            'name' => $title
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'addScoreResult')->willReturn($response->addScoreResult);

        $this->assertTrue($this->subject->addScore($profileId, $scoringGroupId, $score, $title));
    }

    public function testCreateCanReturnInteger()
    {
        $id = 123;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->createResult = 345;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('create')->with([
            'pool_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getInteger')->with($response,
            'createResult')->willReturn($response->createResult);

        $this->assertSame(345, $this->subject->create($id, $hashMap));
    }

    public function testGetByPoolCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $poolAttributeList = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByPoolResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByPool')->with([
            'pool_id' => $id,
            'pool_attribute_list' => $poolAttributeList
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getByPoolResult',
            $config)->willReturn($response->getByPoolResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getByPool($id, $poolAttributeList)
        );
    }

    public function testGetScoresByIdCanReturnInstanceOfProfileGroupScore()
    {
        $id = 'some id';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ProfileGroupScoreInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ProfileGroupScoreInterface::class)->getMock();

        $response = new \stdClass();
        $response->getScoresResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createProfileGroupScoreConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getScores')->with(['profile_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getScoresResult',
            $config)->willReturn($response->getScoresResult);

        $this->assertContainsOnlyInstancesOf(
            ProfileGroupScoreInterface::class,
            $this->subject->getScoresByProfileId($id)
        );
    }

    public function testUpdateByPoolId()
    {
        $id = 234;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->updateByPoolResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('updateByPool')->with([
            'pool_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'updateByPoolResult')->willReturn($response->updateByPoolResult);

        $this->assertTrue($this->subject->updateByPoolId($id, $hashMap));
    }

    public function testGetBouncesCanReturnArrayOfProfileBounceStatus()
    {
        $id = 4;
        $timestampStart = 1533038842;
        $timestampEnd = 1533039923;
        $poolAttributeList = [
            'some datza',
            'some toher data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ProfileBounceStatusInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ProfileBounceStatusInterface::class)->getMock();

        $response = new \stdClass();
        $response->getBouncesResult = [
            $otherObject,
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createProfileBounceStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getBounces')->with([
            'pool_id' => $id,
            'start_time' => $timestampStart,
            'end_time' => $timestampEnd,
            'pool_attribute_list' => $poolAttributeList
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getBouncesResult',
            $config)->willReturn($response->getBouncesResult);

        $this->assertContainsOnlyInstancesOf(
            ProfileBounceStatusInterface::class,
            $this->subject->getBounces($id, $poolAttributeList, $timestampStart, $timestampEnd)
        );
    }

    public function testGetUnsubscriptionsCanReturnArrayOfHashMap()
    {
        $id = 4;
        $timestampStart = 1533038842;
        $timestampEnd = 1533039923;
        $poolAttributeList = [
            'some datza',
            'some toher data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->getUnsubscriptionsResult = [
            $otherObject,
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getUnsubscriptions')->with([
            'pool_id' => $id,
            'start_time' => $timestampStart,
            'end_time' => $timestampEnd,
            'pool_attribute_list' => $poolAttributeList
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getUnsubscriptionsResult',
            $config)->willReturn($response->getUnsubscriptionsResult);

        $this->assertContainsOnlyInstancesOf(
            HashMapInterface::class,
            $this->subject->getUnsubscriptions($id, $poolAttributeList, $timestampStart, $timestampEnd)
        );
    }

    public function testMergeByTargetGroupIdCanReturnBoolean()
    {
        $id = 234;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->mergeByTargetGroupResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('mergeByTargetGroup')->with([
            'target_group_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'mergeByTargetGroupResult')->willReturn($response->mergeByTargetGroupResult);

        $this->assertTrue($this->subject->mergeByTargetGroupId($id, $hashMap));
    }

    public function testMergeByIdCanReturnBoolean()
    {
        $id = 234;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->mergeByIdResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('mergeById')->with([
            'profile_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'mergeByIdResult')->willReturn($response->mergeByIdResult);

        $this->assertTrue($this->subject->mergeById($id, $hashMap));
    }

    public function testGetResultCursorByJobIdCanReturnString()
    {
        $id = 'some job id';

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

    public function testIsInTargetgroupsCanReturnArrayOfTargetGroupMemberShip()
    {
        $id = 123;
        $targetGroupIds = [
            45,
            99,
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(TargetGroupMemberShipInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(TargetGroupMemberShipInterface::class)->getMock();

        $response = new \stdClass();
        $response->isInTargetgroupsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createTargetGroupMemberShipConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('isInTargetgroups')->with([
            'profile_id' => $id,
            'targetgroup_ids' => $targetGroupIds
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'isInTargetgroupsResult',
            $config)->willReturn($response->isInTargetgroupsResult);

        $this->assertContainsOnlyInstancesOf(
            TargetGroupMemberShipInterface::class,
            $this->subject->isInTargetgroups($id, $targetGroupIds)
        );
    }

    public function testGetGrantedPermissionsCanReturnArrayOfHashMap()
    {
        $id = 123;
        $attributes = [
            'some',
            'data',
        ];
        $timestampStart = 1533038842;
        $timestampEnd = 1533058842;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->getGrantedPermissionsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getGrantedPermissions')->with(
            [
                'pool_id' => $id,
                'attributes' => $attributes,
                'start_time' => $timestampStart,
                'end_time' => $timestampEnd,
            ]
        )->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getGrantedPermissionsResult', $config)->willReturn($response->getGrantedPermissionsResult);


        $this->assertContainsOnlyInstancesOf(
            HashMapInterface::class,
            $this->subject->getGrantedPermissions($id, $attributes, $timestampStart, $timestampEnd)
        );
    }

    public function testRevokeTrackingCanReturnBoolean()
    {
        $id = 8;

        $response = new \stdClass();
        $response->revokeTrackingResult = true;

        $this->soapClient->expects($this->once())->method('revokeTracking')->with(['profile_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'revokeTrackingResult')->willReturn($response->revokeTrackingResult);

        $this->assertTrue($this->subject->revokeTracking($id));
    }

    public function testGetByTargetGroupCanReturnInstanceOfJobHandle()
    {
        $id = 123;
        $poolAttributeList = [
            'some',
            'data',
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByTargetGroupResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByTargetGroup')->with([
            'targetgroup_id' => $id,
            'pool_attribute_list' => $poolAttributeList
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getByTargetGroupResult',
            $config)->willReturn($response->getByTargetGroupResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getByTargetGroup($id, $poolAttributeList)
        );
    }

    public function testMergeByKeyCanReturnBoolean()
    {
        $id = 234;
        $key = 'some key';
        $value = 'some value';
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->mergeByKeyResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('mergeByKey')->with([
            'pool_id' => $id,
            'key' => $key,
            'value' => $value,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'mergeByKeyResult')->willReturn($response->mergeByKeyResult);

        $this->assertTrue($this->subject->mergeByKey($id, $key, $value, $hashMap));
    }

    public function testGetTypeIdsCanReturnArrayOfResourceTypeInformation()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceTypeInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getTypeIdsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceTypeInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getTypeIds')->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getTypeIdsResult',
            $config)->willReturn($response->getTypeIdsResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceTypeInformationInterface::class,
            $this->subject->getTypeIds()
        );
    }

    public function testGrantPermission()
    {
        $id = 8;

        $response = new \stdClass();
        $response->grantPermissionResult = true;

        $this->soapClient->expects($this->once())->method('grantPermission')->with(['profile_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'grantPermissionResult')->willReturn($response->grantPermissionResult);

        $this->assertTrue($this->subject->grantPermission($id));
    }

    public function testUpdateByTargetGroupId()
    {
        $id = 234;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->updateByTargetGroupResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('updateByTargetGroup')->with([
            'target_group_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'updateByTargetGroupResult')->willReturn($response->updateByTargetGroupResult);

        $this->assertTrue($this->subject->updateByTargetGroupId($id, $hashMap));
    }

    public function testMassUpdateCanReturnInstanceOfMassUpdateResult()
    {
        $id = 4;
        $keyAttributeTitle = 's-o-m-e t-i-t-l-e';
        $attributes = [
            'attribute a',
            'attribute b',
            'attribute c',
        ];
        $data = [
            'data a',
            'data b',
            'data c'
        ];
        $merge = false;
        $ignoreMissing = true;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MassUpdateResultInterface::class)->getMock();

        $response = new \stdClass();
        $response->massUpdateResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMassUpdateResultConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('massUpdate')->with([
            'pool_id' => $id,
            'key_attribute_name' => $keyAttributeTitle,
            'attributes' => $attributes,
            'data' => $data,
            'merge' => $merge,
            'ignore_missing' => $ignoreMissing
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'massUpdateResult',
            $config)->willReturn($response->massUpdateResult);

        $this->assertInstanceOf(
            MassUpdateResultInterface::class,
            $this->subject->massUpdate($id, $keyAttributeTitle, $attributes, $data, $merge, $ignoreMissing)
        );
    }

    public function testUpdateByKeyCanReturnBoolean()
    {
        $id = 234;
        $key = 'some key';
        $value = 'some value';
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->updateByKeyResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('updateByKey')->with([
            'pool_id' => $id,
            'key' => $key,
            'value' => $value,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'updateByKeyResult')->willReturn($response->updateByKeyResult);

        $this->assertTrue($this->subject->updateByKey($id, $key, $value, $hashMap));
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

    public function testUpdateByIdCanReturnBoolean()
    {
        $id = 234;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->updateByIdResult = true;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('updateById')->with([
            'profile_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'updateByIdResult')->willReturn($response->updateByIdResult);

        $this->assertTrue($this->subject->updateById($id, $hashMap));
    }

    public function testGetByKeyCanReturnArrayOfHashMap()
    {
        $id = 4;
        $key = 'some key';
        $value = 'some value';
        $poolAttributeList = [
            'some datza',
            'some toher data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByKeyResult = [
            $otherObject,
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByKey')->with([
            'pool_id' => $id,
            'key' => $key,
            'value' => $value,
            'pool_attribute_list' => $poolAttributeList
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getByKeyResult',
            $config)->willReturn($response->getByKeyResult);

        $this->assertContainsOnlyInstancesOf(
            HashMapInterface::class,
            $this->subject->getByKey($id, $key, $value, $poolAttributeList)
        );
    }

    public function testGetMailingStatusCanReturnArrayOfMailingStatus()
    {
        $id = 123;
        $mailingId = 45;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(MailingStatusInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(MailingStatusInterface::class)->getMock();

        $response = new \stdClass();
        $response->getMailingStatusResult = [
            $otherObject,
            $object
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createMailingStatusConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getMailingStatus')->with([
            'profile_id' => $id,
            'mailing_id' => $mailingId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getMailingStatusResult',
            $config)->willReturn($response->getMailingStatusResult);

        $this->assertContainsOnlyInstancesOf(
            MailingStatusInterface::class,
            $this->subject->getMailingStatus($id, $mailingId)
        );
    }

    public function testGetJobInformationByJobIdCanReturnInstanceOfJobHandle()
    {
        $id = 'some id';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobHandleInterface::class)->getMock();

        $response = new \stdClass();
        $response->getJobInformationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobHandleConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getJobInformation')->with([
            'job_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getJobInformationResult',
            $config)->willReturn($response->getJobInformationResult);

        $this->assertInstanceOf(
            JobHandleInterface::class,
            $this->subject->getJobInformationByJobId($id)
        );
    }

    public function testGetModifiedProfilesCanReturnArrayOfHashMap()
    {
        $id = 123;
        $attributes = [
            'some',
            'data',
        ];
        $timestampStart = 1533038842;
        $timestampEnd = 1533058842;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->getModifiedProfilesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getModifiedProfiles')->with(
            [
                'pool_id' => $id,
                'attributes' => $attributes,
                'start_time' => $timestampStart,
                'end_time' => $timestampEnd,
            ]
        )->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getModifiedProfilesResult', $config)->willReturn($response->getModifiedProfilesResult);


        $this->assertContainsOnlyInstancesOf(
            HashMapInterface::class,
            $this->subject->getModifiedProfiles($id, $attributes, $timestampStart, $timestampEnd)
        );
    }

    public function testMergeByPoolId()
    {
        $id = 234;
        $hashMap = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->mergeByPoolResult = null;

        $extractedData = [
            'some' => 'data'
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with($config,
            $hashMap)->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('mergeByPool')->with([
            'pool_id' => $id,
            'data' => $extractedData
        ])->willReturn($response);

        $this->assertNull($this->subject->mergeByPoolId($id, $hashMap));
    }

    public function testGetResultByJobIdCanReturnInstanceOfJobResult()
    {
        $id = 'some id';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(JobResultInterface::class)->getMock();

        $response = new \stdClass();
        $response->getResultsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createJobResultConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getResults')->with([
            'job_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'getResultsResult',
            $config)->willReturn($response->getResultsResult);

        $this->assertInstanceOf(
            JobResultInterface::class,
            $this->subject->getResultByJobId($id)
        );
    }

    public function testRevokePermissionCanReturnBoolean()
    {
        $id = 8;

        $response = new \stdClass();
        $response->revokePermissionResult = true;

        $this->soapClient->expects($this->once())->method('revokePermission')->with(['profile_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'revokePermissionResult')->willReturn($response->revokePermissionResult);

        $this->assertTrue($this->subject->revokePermission($id));
    }

    public function testDeleteCanReturnBoolean()
    {
        $profileIds = [
            1,
            2,
            3,
            4,
            5
        ];

        $response = new \stdClass();
        $response->deleteResult = true;

        $this->soapClient->expects($this->once())->method('delete')->with(['profile_ids' => $profileIds])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'deleteResult')->willReturn($response->deleteResult);

        $this->assertTrue($this->subject->delete($profileIds));
    }

    public function testGetActivityScoringHistoryCanREturnArrayOfProfileActivityScore()
    {
        $id = 123;
        $scoringGroupId = 2345;
        $scoringTypeId = 234;
        $resourceId = 3223;
        $timestampStart =1533038842;
        $timestampEnd = 1534038842;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ProfileActivityScoreInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ProfileActivityScoreInterface::class)->getMock();

        $response = new \stdClass();
        $response->getActivityScoringHistoryResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createProfileActivityScoreConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getActivityScoringHistory')->with(
            [
                'profile_id' => $id,
                'scoring_group_id' => $scoringGroupId,
                'scoring_type_id' => $scoringTypeId,
                'resource_id' => $resourceId,
                'start_timestamp' => $timestampStart,
                'end_timestamp' => $timestampEnd,
            ]
        )->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getActivityScoringHistoryResult', $config)->willReturn($response->getActivityScoringHistoryResult);


        $this->assertContainsOnlyInstancesOf(
            ProfileActivityScoreInterface::class,
            $this->subject->getActivityScoringHistory($id, $scoringGroupId, $scoringTypeId, $resourceId, $timestampStart, $timestampEnd)
        );
    }

    public function testGetByIdCanReturnInstanceOfHashMap()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(HashMapInterface::class)->getMock();

        $response = new \stdClass();
        $response->getByIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getById')->with(
            [
                'profile_id' => $id,
            ]
        )->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response,
            'getByIdResult', $config)->willReturn($response->getByIdResult);


        $this->assertInstanceOf(
            HashMapInterface::class,
            $this->subject->getById($id)
        );
    }

    public function testUnTagWithOptionCanReturnBoolean()
    {
        $id = 234;
        $key = 'some key';
        $values = [
            'some value',
            'some other value'
        ];
        $doUpdate = true;

        $response = new \stdClass();
        $response->untagWithOptionResult = true;

        $this->soapClient->expects($this->once())->method('untagWithOption')->with([
            'pool_attribute_option_id' => $id,
            'key' => $key,
            'values' => $values,
            'set_profile_edit_date_and_fire_update_event' => $doUpdate
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'untagWithOptionResult')->willReturn($response->untagWithOptionResult);

        $this->assertTrue($this->subject->unTagWithOption($id, $values, $key, $doUpdate));
    }

    public function testTagWithOptionCanReturnBoolean()
    {
        $id = 234;
        $key = 'some key';
        $values = [
            'some value',
            'some other value'
        ];
        $doUpdate = true;

        $response = new \stdClass();
        $response->tagWithOptionResult = true;

        $this->soapClient->expects($this->once())->method('tagWithOption')->with([
            'pool_attribute_option_id' => $id,
            'key' => $key,
            'values' => $values,
            'set_profile_edit_date_and_fire_update_event' => $doUpdate
        ])->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getBoolean')->with($response,
            'tagWithOptionResult')->willReturn($response->tagWithOptionResult);

        $this->assertTrue($this->subject->tagWithOption($id, $values, $key, $doUpdate));
    }

    public function testGetTrackingHistoryCanReturnArrayOfProfileTrackingHistory()
    {
        $profileId = 333;
        $timestampStart = 123456;
        $timestampEnd = 234567;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ProfileTrackingHistoryInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ProfileTrackingHistoryInterface::class)->getMock();

        $response = new \stdClass();
        $response->getTrackingHistoryResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createProfileTrackingHistoryConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getTrackingHistory')->with(
            [
                'profile_id' => $profileId,
                'from' => $timestampStart,
                'to' => $timestampEnd
            ]
        )->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response,
            'getTrackingHistoryResult', $config)->willReturn($response->getTrackingHistoryResult);


        $this->assertContainsOnlyInstancesOf(
            ProfileTrackingHistoryInterface::class,
            $this->subject->getTrackingHistory($profileId, $timestampStart, $timestampEnd)
        );
    }
}
