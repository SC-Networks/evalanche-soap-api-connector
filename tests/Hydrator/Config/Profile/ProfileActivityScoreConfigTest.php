<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile\ProfileActivityScoreConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileActivityScoreInterface;

/**
 * Class ProfileActivityScoreConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileActivityScoreConfigTest extends TestCase
{
    /**
     * @var ProfileActivityScoreConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'scoring_group_id',
        'scoring_type_id',
        'timestamp',
        'value',
        'resource_id',
    ];

    public function setUp(): void
    {
        $this->subject = new ProfileActivityScoreConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ProfileActivityScoreInterface::class,
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
