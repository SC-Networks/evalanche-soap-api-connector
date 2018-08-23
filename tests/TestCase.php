<?php

namespace Scn\EvalancheSoapApiConnector;

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
     * @return \PHPUnit\Framework\MockObject\MockObject
     * @throws \ReflectionException
     */
    public function getWsdlMock(array $wsdl_methods = [])
    {
        return $this->getMockFromWsdl(__DIR__ . '/evalanche.wsdl', '', '', $wsdl_methods);
    }

}