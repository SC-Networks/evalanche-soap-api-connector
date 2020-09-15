<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

abstract class ConfigTestCase extends \PHPUnit\Framework\TestCase
{

    public function testGetHydratorPropertiesCanReturnArray()
    {
        $subject = $this->getSubject();
        
        foreach ($this->getArrayKeys() as $arrayKey) {
            $this->assertArrayHasKey($arrayKey, $subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        $subject = $this->getSubject();
        
        foreach ($this->getArrayKeys() as $arrayKey) {
            $this->assertArrayHasKey($arrayKey, $subject->getExtractorProperties());
        }
    }
    
    abstract protected function getArrayKeys(): array;
    
    abstract protected function getSubject();
}