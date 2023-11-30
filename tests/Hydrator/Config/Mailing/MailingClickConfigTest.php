<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingClickInterface;

/**
 * Class MailingClickConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingClickConfigTest extends TestCase
{
    /**
     * @var MailingClickConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'profile_id',
        'timestamp',
        'link_id',
        'link_type_id',
        'parent_id',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingClickConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            MailingClickInterface::class,
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
