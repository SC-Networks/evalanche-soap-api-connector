<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

/**
 * Class EvalancheConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class EvalancheConfigTest extends TestCase
{
    /** @var EvalancheConfig */
    private $subject;

    /** @var array<string, mixed> */
    private $soapSettings = ['some' => 'setting'];

    public function setUp(): void
    {
        $this->subject = new EvalancheConfig(
            'some hostname',
            'some username',
            'some password',
            true,
            $this->soapSettings
        );
    }

    public function testGetUsernameCanReturnUsername()
    {
        self::assertSame('some username', $this->subject->getUsername());
    }

    public function testGetPasswordCanReturnPassword()
    {
        self::assertSame('some password', $this->subject->getPassword());
    }

    public function testGetWsdlServiceUrlCanReturnWsdlUrl()
    {
        $wsdlUri = 'some wsdl uri';

        self::assertSame(
            sprintf('https://%s/%s', 'some hostname', $wsdlUri),
            $this->subject->getWsdlServiceUrl($wsdlUri)
        );
    }

    public function testGetDebugModeCanReturnBoolean()
    {
        $this->assertTrue($this->subject->getDebugMode());
    }

    public function testGetSoapSettingsReturnsData(): void
    {
        self::assertSame(
            $this->soapSettings,
            $this->subject->getSoapClientOptions()
        );
    }
}
