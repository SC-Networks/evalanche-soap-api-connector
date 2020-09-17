<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\User;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
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
        $this->soapClient = $this->getWsdlMock(['getByUsername', 'getAll', 'update']);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new UserClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetByUsernameCanReturnInstanceOfUserInterface()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(UserInterface::class)->getMock();

        $result = new stdClass();
        $result->getByUsernameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createUserConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getByUsername')->with(['username' => 'some username'])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $result,
            'getByUsernameResult',
            $config
        )->willReturn($object);

        $this->assertSame(
            $object,
            $this->subject->getByUsername('some username')
        );
    }

    public function testGetListByMandatorIdCanReturnArrayOfUserInterface()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(UserInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(UserInterface::class)->getMock();

        $list = new stdClass();
        $list->item = [
            $object,
            $otherObject
        ];

        $result = new stdClass();
        $result->getAllResult = $list;

        $this->hydratorConfigFactory->expects($this->once())->method('createUserConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAll')->willReturn($result);
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
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(UserInterface::class)->getMock();

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
        $this->soapClient->expects($this->once())->method('update')->with(['user' => $expectedExtractor])->willReturn($result);
        $this->responseMapper->expects($this->once())->method('getObject')
            ->with($result, 'updateResult', $config)
            ->willReturn($object);

        $this->assertInstanceOf(
            UserInterface::class,
            $this->subject->updateUser($object)
        );
    }
}
