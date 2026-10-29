<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\User;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;
use stdClass;

/**
 * Class UserClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\User
 */
class UserClientTest extends TestCase
{
    /**
     * @var UserClient
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
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

        $this->subject = new UserClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetByUsernameCanReturnInstanceOfUserInterface()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(UserInterface::class);

        $result = new stdClass();
        $result->getByUsernameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createUserConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getByUsername',
                [[
                    'username' => 'some username'
                ]]
            )
            ->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $result,
            'getByUsernameResult',
            $config
        )->willReturn($object);

        self::assertSame(
            $object,
            $this->subject->getByUsername('some username')
        );
    }

    public function testGetListByMandatorIdCanReturnArrayOfUserInterface()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(UserInterface::class);
        $otherObject = $this->createStub(UserInterface::class);

        $list = new stdClass();
        $list->item = [
            $object,
            $otherObject
        ];

        $result = new stdClass();
        $result->getAllResult = $list;

        $this->hydratorConfigFactory->expects($this->once())->method('createUserConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getAll',
                [[
                    'mandator_id' => 123
                ]]
            )
            ->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObjects')
            ->with($result, 'getAllResult', $config)
            ->willReturn([$object, $otherObject]);

        $this->assertContainsOnlyInstancesOf(
            UserInterface::class,
            $this->subject->getListByMandatorId(123)
        );
    }

    public function testUpdateUserCanReturnInstanceOfUserInterface()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(UserInterface::class);

        $result = new stdClass();
        $result->updateResult = $object;

        $expectedExtractor = [
            'some' => 'value'
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createUserConfig')->willReturn($config);
        $this->extractor->expects($this->once())->method('extract')->with(
            $config,
            $object
        )->willReturn($expectedExtractor);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'update',
                [[
                    'user' => $expectedExtractor
                ]]
            )
            ->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObject')
            ->with($result, 'updateResult', $config)
            ->willReturn($object);

        self::assertInstanceOf(
            UserInterface::class,
            $this->subject->updateUser($object)
        );
    }
}
