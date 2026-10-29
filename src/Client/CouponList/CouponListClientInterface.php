<?php

declare(strict_types=1);

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
     *
     * @throws EmptyResultException
     */
    public function create(
        string $title,
        int $folderId
    ): ResourceInformationInterface;

    /**
     * Generates simple coupon-codes
     *
     * @param int $amount The amount of coupon codes to be generated
     *
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
     *
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
     *
     *
     * @throws EmptyResultException
     */
    public function removeAll(
        int $couponListId
    ): bool;

    /**
     * Returns a list of all coupon codes
     *
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
     * @param ProfileCouponInterface[] $profileCouponItems
     *
     *
     * @throws EmptyResultException
     */
    public function import(
        int $couponListId,
        array $profileCouponItems
    ): bool;
}
