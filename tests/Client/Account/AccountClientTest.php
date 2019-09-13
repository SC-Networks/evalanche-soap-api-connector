<?php

namespace Scn\EvalancheSoapApiConnector\Client\Account;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\AccountInterface;

/**
 * Class AccountClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Account
 */
class AccountClientTest extends TestCase
{
    /**
     * @var AccountClient
     */
    private $subject;

    /**
     * @var EvalancheSoapClient|MockObject
     */
    private $soapClient;

    /**
     * @var ResponseMapperInterface|MockObject
     */
    private $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface|MockObject
     */
    private $hydratorConfigFactory;

    /**
     * @var ExtractorInterface|MockObject
     */
    private $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock([
            'getAccount',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new AccountClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetAccountByMandatorIdCanReturnInstanceAccountInterface()
    {
        $mandatorId = 523;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(AccountInterface::class)->getMock();

        $response = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createAccountConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAccount')->with([
            'CustomerId' => $mandatorId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjectDirectly')->with(
            $response,
            $config
        )->willReturn($response);

        $this->assertInstanceOf(
            AccountInterface::class,
            $this->subject->getAccountByMandatorId($mandatorId)
        );
    }

    public function testGetWsdlUriCanReturnString()
    {
        $this->assertSame('api/soap/v1/accounting/wsdl', $this->subject->getWsdlUri());
    }
}
