<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapApiConnector\Exception\DebugRequestException;
use Scn\EvalancheSoapApiConnector\Exception\RequestException;

/**
 * Class EvalancheSoapClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client
 */
class EvalancheSoapClientTest extends TestCase
{
    private EvalancheSoapClient $subject;

    public function setUp(): void
    {
        $portname = __DIR__ . '/evalanche.wsdl';

        $this->subject = new EvalancheSoapClient(
            $portname,
            []
        );
    }

    public function testCallCanCatchException(): void
    {
        $this->expectException(RequestException::class);
        $this->subject->__call('something', []);
    }

    public function testCallCanCatchExceptionAndThrowDebugException(): void
    {
        $this->expectException(DebugRequestException::class);
        $this->subject->setDebugMode(true)->__call('something', []);
    }

    public function testGetDebugModeCanReturnBoolean(): void
    {
        $this->assertFalse($this->subject->getDebugMode());
    }

    public function testSetDebugModeCanSetBoolean(): void
    {
        $this->assertTrue($this->subject->setDebugMode(true)->getDebugMode());
    }
}
