<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfigurationInterface;

/**
 * Class SmartLinkConfigurationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkConfigurationConfigTest extends TestCase
{
    /**
     * @var SmartLinkConfigurationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'target_url',
        'individual_scoring_config',
        'restriction_targetgroup_id',
        'restriction_useragents',
        'milestone_id',
        'activate_redirect',
        'activate_profile_update',
        'activate_tracking',
        'scoring_configs',
        'pool_attributes'
    ];

    public function setUp(): void
    {
        $this->subject = new SmartLinkConfigurationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            SmartLinkConfigurationInterface::class,
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
