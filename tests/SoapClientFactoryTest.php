<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector;

use SoapClient;
use SoapFault;

/**
 * Class SoapClientFactoryTest
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class SoapClientFactoryTest extends TestCase
{
    /**
     * @var SoapClientFactory
     */
    private $subject;

    public function setUp(): void
    {
        $this->subject = new SoapClientFactory();
    }

    public function testCreateCanReturnThrowException()
    {
        $portname = 'evalanche.wsdl';

        $config = $this->getMockBuilder(EvalancheConfigInterface::class)->getMock();
        $config->expects($this->once())->method('getWsdlServiceUrl')->with($portname)->willReturn('something wrong');

        $this->expectException(SoapFault::class);
        $this->subject->create($config, $portname);
    }

    public function testCreateCanReturnReturnInstanceOfSoap()
    {
        $portname = 'evalanche.wsdl';
        $config = $this->getMockBuilder(EvalancheConfigInterface::class)->getMock();
        $config->expects($this->once())->method('getUsername')->willReturn('some username');
        $config->expects($this->once())->method('getPassword')->willReturn('some password');
        $config->expects($this->once())->method('getWsdlServiceUrl')->with($portname)->willReturn(__DIR__ . '/' . $portname);


        self::assertInstanceOf(
            SoapClient::class,
            $this->subject->create($config, $portname)
        );
    }

    public function testCreateCanReturnReturnInstanceOfSoapWithDebugSettings()
    {
        $portname = 'evalanche.wsdl';
        $config = $this->getMockBuilder(EvalancheConfigInterface::class)->getMock();
        $config->expects($this->exactly(2))->method('getDebugMode')->willReturn(true);
        $config->expects($this->once())->method('getUsername')->willReturn('some username');
        $config->expects($this->once())->method('getPassword')->willReturn('some password');
        $config->expects($this->once())->method('getWsdlServiceUrl')->with($portname)->willReturn(__DIR__ . '/' . $portname);

        self::assertInstanceOf(
            SoapClient::class,
            $this->subject->create($config, $portname)
        );
    }
}
