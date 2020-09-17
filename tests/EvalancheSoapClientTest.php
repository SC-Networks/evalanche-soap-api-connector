<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use Scn\EvalancheSoapApiConnector\Exception\DebugRequestException;
use Scn\EvalancheSoapApiConnector\Exception\RequestException;

/**
 * Class EvalancheSoapClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client
 */
class EvalancheSoapClientTest extends TestCase
{
    /**
     * @var EvalancheSoapClient
     */
    private $subject;

    public function setUp(): void
    {
        $portname = __DIR__ . '/evalanche.wsdl';

        $this->subject = new EvalancheSoapClient(
            $portname,
            []
        );
    }

    public function testCallCanCatchException()
    {
        $this->expectException(RequestException::class);
        $this->subject->__call('something', []);
    }

    public function testCallCanCatchExceptionAndThrowDebugException()
    {
        $this->expectException(DebugRequestException::class);
        $this->subject->setDebugMode(true)->__call('something', []);
    }

    public function testGetDebugModeCanReturnBoolean()
    {
        $this->assertFalse($this->subject->getDebugMode());
    }

    public function testSetDebugModeCanSetBoolean()
    {
        $this->assertTrue($this->subject->setDebugMode(true)->getDebugMode());
    }
}
