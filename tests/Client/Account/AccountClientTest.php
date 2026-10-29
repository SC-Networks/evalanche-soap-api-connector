<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Account;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
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
     * @var Stub&ExtractorInterface
     */
    private Stub $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createStub(ExtractorInterface::class);

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

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(AccountInterface::class);

        $response = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createAccountConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getAccount',
                [[
                    'CustomerId' => $mandatorId
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjectDirectly')->with(
            $response,
            $config
        )->willReturn($response);

        self::assertInstanceOf(
            AccountInterface::class,
            $this->subject->getAccountByMandatorId($mandatorId)
        );
    }

    public function testGetWsdlUriCanReturnString()
    {
        self::assertSame('api/soap/v1/accounting/wsdl', $this->subject->getWsdlUri());
    }
}
