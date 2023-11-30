<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormStatisticInterface;

/**
 * Class FormStatisticConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class FormStatisticConfigTest extends TestCase
{
    /**
     * @var FormStatisticConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'is_alias',
        'impressions',
        'succeeded',
        'identity_errors',
        'duplication_errors',
        'validation_errors',
        'mandatory_errors',
    ];

    public function setUp(): void
    {
        $this->subject = new FormStatisticConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            FormStatisticInterface::class,
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
