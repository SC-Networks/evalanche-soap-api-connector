<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkPoolConfigurationInterface;

/**
 * Class SmartLinkPoolConfigurationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkPoolConfigurationConfigTest extends TestCase
{
    /**
     * @var SmartLinkPoolConfigurationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'pool_id',
        'pool_attribute_id',
        'value',
        'is_merge'
    ];

    public function setUp(): void
    {
        $this->subject = new SmartLinkPoolConfigurationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            SmartLinkPoolConfigurationInterface::class,
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
