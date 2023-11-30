<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\CouponList;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\CouponList\ProfileCouponInterface;

class CouponListProfileCouponConfigTest extends TestCase
{
    /** @var CouponListProfileCouponConfig|null */
    private $subject;

    private $arrayKeys = [
        'id',
        'code',
        'profile_id',
        'creation_date',
        'valid_to',
    ];

    public function setUp(): void
    {
        $this->subject = new CouponListProfileCouponConfig();
    }

    public function testGetObjectReturnsObject(): void
    {
        self::assertInstanceOf(
            ProfileCouponInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
