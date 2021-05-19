<?php

namespace Scn\EvalancheSoapApiConnector\Client\CouponList;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\CouponList\ProfileCouponInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

class CouponListClient extends AbstractClient implements CouponListClientInterface
{
    use ResourceTrait;

    public const PORTNAME = 'couponlist';
    public const VERSION = ClientInterface::VERSION_V0;

    /**
     * Creates a coupon list object
     *
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(
        string $title,
        int $folderId
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->create(
                [
                    'name' => $title,
                    'category_id' => $folderId,
                ]
            ),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * Generates simple coupon-codes
     *
     * @param int $couponListId
     * @param int $amount The amount of coupon codes to be generated
     *
     * @return bool
     *
     * @throws EmptyResultException
     */
    public function generate(
        int $couponListId,
        int $amount
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->generate(
                [
                    'coupon_list_id' => $couponListId,
                    'amount' => $amount,
                ]
            ),
            'generateResult'
        );
    }

    /**
     * Removes a certain coupon code from a list
     *
     * @param int $couponListId
     * @param int $profileCouponId
     *
     * @return bool
     *
     * @throws EmptyResultException
     */
    public function removeById(
        int $couponListId,
        int $profileCouponId
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeById(
                [
                    'coupon_list_id' => $couponListId,
                    'profile_coupon_id' => $profileCouponId,
                ]
            ),
            'removeByIdResult'
        );
    }

    /**
     * Removes all coupon codes from a coupon list
     *
     * @param int $couponListId
     *
     * @return bool
     *
     * @throws EmptyResultException
     */
    public function removeAll(
        int $couponListId
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAll(
                [
                    'coupon_list_id' => $couponListId,
                ]
            ),
            'removeAllResult'
        );
    }

    /**
     * Returns a list of all coupon codes
     *
     * @param int $couponListId
     *
     * @return ProfileCouponInterface[]
     *
     * @throws EmptyResultException
     */
    public function getProfileCouponList(
        int $couponListId
    ): array {
        return $this->responseMapper->getObjects(
            $this->soapClient->getProfileCouponList(
                [
                    'coupon_list_id' => $couponListId,
                ]
            ),
            'getProfileCouponListResult',
            $this->hydratorConfigFactory->createCouponListProfileCouponConfig()
        );
    }

    /**
     * Imports a list of profile coupons
     *
     * @param int $couponListId
     * @param ProfileCouponInterface[] $profileCouponItems
     *
     * @return bool
     *
     * @throws EmptyResultException
     */
    public function import(
        int $couponListId,
        array $profileCouponItems
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->import(
                [
                    'coupon_list_id' => $couponListId,
                    'data' => $this->extractor->extractArray(
                        $this->hydratorConfigFactory->createCouponListProfileCouponConfig(),
                        $profileCouponItems
                    ),
                ]
            ),
            'importResult'
        );
    }
}
