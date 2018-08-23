<?php

namespace Scn\EvalancheSoapApiConnector;

/**
 * Class EvalancheConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class EvalancheConfigTest extends TestCase
{
    /**
     * @var EvalancheConfig
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new EvalancheConfig(
            'some hostname',
            'some username',
            'some password',
            true
        );
    }

    public function testGetUsernameCanReturnUsername()
    {
        $this->assertSame('some username', $this->subject->getUsername());
    }

    public function testGetPasswordCanReturnPassword()
    {
        $this->assertSame('some password', $this->subject->getPassword());
    }

    public function testGetWsdlServiceUrlCanReturnWsdlUrl()
    {
        $wsdlUri = 'some wsdl uri';

        $this->assertSame(sprintf('https://%s/%s', 'some hostname', $wsdlUri),
            $this->subject->getWsdlServiceUrl($wsdlUri));
    }

    public function testGetDebugModeCanReturnBoolean()
    {
        $this->assertTrue($this->subject->getDebugMode());
    }

}
