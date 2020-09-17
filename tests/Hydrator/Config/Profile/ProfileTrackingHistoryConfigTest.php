<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistoryInterface;

/**
 * Class ProfileTrackingHistoryConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileTrackingHistoryConfigTest extends TestCase
{
    /**
     * @var ProfileTrackingHistoryConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ProfileTrackingHistoryInterface::class,
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
