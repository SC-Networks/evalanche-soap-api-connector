<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\CouponList;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\CouponList\ProfileCouponInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use stdClass;

class CouponListClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var CouponListClient
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
        $this->soapClient = $this->getWsdlMock([
            'create',
            'generate',
            'removeById',
            'removeAll',
            'getProfileCouponList',
            'import',
            'rename',
            'move',
            'copy',
            'delete',
        ]);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

        $this->subject = new CouponListClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateReturnsResourceInformationInterface(): void
    {
        $folderId = 123;
        $title = 'some title';

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('create')
            ->with([
                'name' => $title,
                'category_id' => $folderId,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'createResult',
                $config
            )
            ->willReturn($response->createResult);

        $this->assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($title, $folderId)
        );
    }

    public function testGenerateReturnsBoolean(): void
    {
        $couponListId = 123;
        $amount = 666;

        $response = new stdClass();
        $response->generateResult = true;

        $this->soapClient->expects($this->once())
            ->method('generate')
            ->with([
                'coupon_list_id' => $couponListId,
                'amount' => $amount,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'generateResult'
            )
            ->willReturn($response->generateResult);

        $this->assertTrue(
            $this->subject->generate($couponListId, $amount)
        );
    }

    public function testRemoveByIdReturnsBoolean(): void
    {
        $couponListId = 123;
        $profileCouponId = 666;

        $response = new stdClass();
        $response->removeByIdResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeById')
            ->with([
                'coupon_list_id' => $couponListId,
                'profile_coupon_id' => $profileCouponId,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'removeByIdResult'
            )
            ->willReturn($response->removeByIdResult);

        $this->assertTrue(
            $this->subject->removeById($couponListId, $profileCouponId)
        );
    }

    public function testRemoveAllReturnsBoolean(): void
    {
        $couponListId = 123;

        $response = new stdClass();
        $response->removeAllResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeAll')
            ->with([
                'coupon_list_id' => $couponListId
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'removeAllResult'
            )
            ->willReturn($response->removeAllResult);

        $this->assertTrue(
            $this->subject->removeAll($couponListId)
        );
    }

    public function testGetProfileCouponListReturnsData(): void
    {
        $profileCouponId = 1234;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(ProfileCouponInterface::class);

        $response = new stdClass();
        $response->getProfileCouponListResult = [
            $object,
        ];

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createCouponListProfileCouponConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getProfileCouponList')
            ->with([
                'coupon_list_id' => $profileCouponId,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')->with(
                $response,
                'getProfileCouponListResult',
                $config
            )
            ->willReturn($response->getProfileCouponListResult);

        $this->assertContainsOnlyInstancesOf(
            ProfileCouponInterface::class,
            $this->subject->getProfileCouponList($profileCouponId)
        );
    }

    public function testImportReturnsBoolean(): void
    {
        $couponListId = 1234;
        
        $coupons = [
            $this->createMock(ProfileCouponInterface::class),
        ];
        $config = $this->createMock(HydratorConfigInterface::class);

        $response = new stdClass();
        $response->importResult = true;

        $extractedData = [
            [
                'some' => 'data'
            ],
        ];

        $this->extractor->expects($this->once())
            ->method('extractArray')
            ->with(
                $config,
                $coupons
            )
            ->willReturn($extractedData);

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createCouponListProfileCouponConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('import')
            ->with([
                'coupon_list_id' => $couponListId,
                'data' => $extractedData
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'importResult',
            )
            ->willReturn($response->importResult);

        $this->assertTrue(
            $this->subject->import($couponListId, $coupons)
        );
    }
}
