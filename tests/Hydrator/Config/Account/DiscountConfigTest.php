<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\DiscountInterface;

/**
 * Class DiscountConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class DiscountConfigTest extends TestCase
{
    /**
     * @var DiscountConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'Description',
        'Percent',
        'Price'
    ];

    public function setUp(): void
    {
        $this->subject = new DiscountConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            DiscountInterface::class,
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
