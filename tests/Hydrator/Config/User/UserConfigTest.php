<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\User;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;

/**
 * Class UserConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\User
 */
class UserConfigTest extends TestCase
{
    /**
     * @var UserConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            UserInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
