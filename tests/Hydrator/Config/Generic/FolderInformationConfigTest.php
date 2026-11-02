<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;

/**
 * Class FolderInformationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class FolderInformationConfigTest extends TestCase
{
    private FolderInformationConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'parent_id'
    ];

    public function setUp(): void
    {
        $this->subject = new FolderInformationConfig();
    }

    public function testGetObjectCanReturnInstanceOfFolderInformation(): void
    {
        self::assertInstanceOf(
            FolderInformationInterface::class,
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
