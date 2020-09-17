<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileGroupScoreInterface;

/**
 * Class ProfileGroupScoreConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileGroupScoreConfigTest extends TestCase
{
    /**
     * @var ProfileGroupScoreConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'profile_id',
        'group_id',
        'group_name',
        'activity_score',
        'profile_score',
    ];

    public function setUp(): void
    {
        $this->subject = new ProfileGroupScoreConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ProfileGroupScoreInterface::class,
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
