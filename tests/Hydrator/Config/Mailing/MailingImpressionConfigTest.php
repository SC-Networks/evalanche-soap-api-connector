<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingImpressionInterface;

/**
 * Class MailingImpressionConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingImpressionConfigTest extends TestCase
{
    private MailingImpressionConfig $subject;

    private array $arrayKeys = [
        'id',
        'profile_id',
        'timestamp',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingImpressionConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MailingImpressionInterface::class,
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
