<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\TestCase;

/**
 * Class EvalancheConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class EvalancheConfigTest extends TestCase
{
    private EvalancheConfig $subject;

    /** @var array<string, mixed> */
    private array $soapSettings = ['some' => 'setting'];

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

    public function testGetUsernameCanReturnUsername(): void
    {
        self::assertSame('some username', $this->subject->getUsername());
    }

    public function testGetPasswordCanReturnPassword(): void
    {
        self::assertSame('some password', $this->subject->getPassword());
    }

    public function testGetWsdlServiceUrlCanReturnWsdlUrl(): void
    {
        $wsdlUri = 'some wsdl uri';

        self::assertSame(
            sprintf('https://%s/%s', 'some hostname', $wsdlUri),
            $this->subject->getWsdlServiceUrl($wsdlUri)
        );
    }

    public function testGetDebugModeCanReturnBoolean(): void
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
