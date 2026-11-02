<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfigurationInterface;

/**
 * Class SmartLinkConfigurationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkConfigurationConfigTest extends TestCase
{
    private SmartLinkConfigurationConfig $subject;

    private array $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            SmartLinkConfigurationInterface::class,
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
