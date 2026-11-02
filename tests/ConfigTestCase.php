<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\TestCase;

abstract class ConfigTestCase extends TestCase
{
    public function testGetHydratorPropertiesCanReturnArray(): void
    {
        $subject = $this->getSubject();
        
        foreach ($this->getArrayKeys() as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray(): void
    {
        $subject = $this->getSubject();
        
        foreach ($this->getArrayKeys() as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $subject->getExtractorProperties());
        }
    }
    
    abstract protected function getArrayKeys(): array;
    
    abstract protected function getSubject();
}
