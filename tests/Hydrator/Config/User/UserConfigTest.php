<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\User;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;

/**
 * Class UserConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\User
 */
class UserConfigTest extends TestCase
{
    private UserConfig $subject;

    private array $arrayKeys = [
        'id',
        'mandator_id',
        'username',
        'email',
        'salutation',
        'firstname',
        'name',
        'description',
        'security_guideline_id',
        'role_ids',
        'disabled',
        'password',
    ];

    public function setUp(): void
    {
        $this->subject = new UserConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            UserInterface::class,
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
