<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistoryInterface;

/**
 * Class ProfileTrackingHistoryConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileTrackingHistoryConfigTest extends TestCase
{
    private ProfileTrackingHistoryConfig $subject;

    private array $arrayKeys = [
        'id',
        'resource_id',
        'resource_name',
        'resource_type_id',
        'sub_resource_id',
        'sub_resource_name',
        'sub_resource_type_id',
        'sub_url',
        'profile_id',
        'type',
        'timestamp',
        'referrer_domain'
    ];

    public function setUp(): void
    {
        $this->subject = new ProfileTrackingHistoryConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ProfileTrackingHistoryInterface::class,
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
