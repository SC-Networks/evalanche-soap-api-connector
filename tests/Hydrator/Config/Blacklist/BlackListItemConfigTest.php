<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListItemInterface;

/**
 * Class BlackListItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist
 */
class BlackListItemConfigTest extends TestCase
{
    /**
     * @var BlackListItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'Email',
        'Description',
    ];

    public function setUp(): void
    {
        $this->subject = new BlackListItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            BlackListItemInterface::class,
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
