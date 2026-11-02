<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkPoolConfigurationInterface;

/**
 * Class SmartLinkPoolConfigurationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkPoolConfigurationConfigTest extends TestCase
{
    private SmartLinkPoolConfigurationConfig $subject;

    private array $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            SmartLinkPoolConfigurationInterface::class,
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
