<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile\ProfileBounceStatusConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatusInterface;

/**
 * Class ProfileBounceStatusConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileBounceStatusConfigTest extends TestCase
{
    /**
     * @var ProfileBounceStatusConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'profile_id',
        'mailing_id',
        'status',
        'timestamp',
        'profile_data',
    ];

    public function setUp()
    {
        $this->subject = new ProfileBounceStatusConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ProfileBounceStatusInterface::class,
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
