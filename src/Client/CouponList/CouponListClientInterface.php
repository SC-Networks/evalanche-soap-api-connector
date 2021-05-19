<?php

namespace Scn\EvalancheSoapApiConnector\Client\CouponList;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\CouponList\ProfileCouponInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

interface CouponListClientInterface extends ClientInterface, ResourceTraitInterface
{
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
    ): ResourceInformationInterface;

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
    ): bool;

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
    ): bool;

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
    ): bool;

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
    ): array;

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
    ): bool;
}
