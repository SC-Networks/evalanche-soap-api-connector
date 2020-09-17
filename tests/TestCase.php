<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\MockObject\MockObject;
use ReflectionException;

/**
 * Class TestCase
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class TestCase extends \PHPUnit\Framework\TestCase
{

    /**
     * @param array $wsdl_methods
     *
     * @return MockObject
     * @throws ReflectionException
     */
    public function getWsdlMock(array $wsdl_methods = [])
    {
        return $this->getMockFromWsdl(__DIR__ . '/evalanche.wsdl', '', '', $wsdl_methods);
    }
}
