<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatusInterface;

/**
 * Class ProfileBounceStatusConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileBounceStatusConfigTest extends TestCase
{
    private ProfileBounceStatusConfig $subject;

    private array $arrayKeys = [
        'profile_id',
        'mailing_id',
        'status',
        'timestamp',
        'profile_data',
    ];

    public function setUp(): void
    {
        $this->subject = new ProfileBounceStatusConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ProfileBounceStatusInterface::class,
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
