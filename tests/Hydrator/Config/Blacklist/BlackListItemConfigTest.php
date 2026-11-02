<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListItemInterface;

/**
 * Class BlackListItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist
 */
class BlackListItemConfigTest extends TestCase
{
    private BlackListItemConfig $subject;

    private array $arrayKeys = [
        'Email',
        'Description',
    ];

    public function setUp(): void
    {
        $this->subject = new BlackListItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            BlackListItemInterface::class,
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
