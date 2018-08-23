<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\User;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\User\UserConfig;
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

    public function setUp()
    {
        $this->subject = new UserConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            UserInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            $this->assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            $this->assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
