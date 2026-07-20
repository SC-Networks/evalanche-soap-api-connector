<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client;

use DateInterval;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use stdClass;

/**
 * Adds tests for methods all resource related clients have in common
 */
trait CommonResourceMethodsTestTrait
{
    public function testUpdateTitleCanReturnInstanceOfResourceInformationInterface()
    {
        $id = 123;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->renameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('rename')->with([
            'resource_id' => $id,
            'name' => $title,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'renameResult',
            $config
        )->willReturn($response->renameResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->updateTitle($id, $title)
        );
    }

    public function testMoveCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $folderId = 34;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->moveResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('move')->with([
            'resource_id' => $id,
            'category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'moveResult',
            $config
        )->willReturn($response->moveResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->move($id, $folderId)
        );
    }

    public function testDeleteCanReturnBoolean()
    {
        $id = 56;

        $response = new stdClass();
        $response->deleteResult = true;

        $this->soapClient->expects($this->once())->method('delete')->with(['resource_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'deleteResult'
        )->willReturn($response->deleteResult);

        $this->assertTrue($this->subject->delete($id));
    }

    public function testCopyCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $folderId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->copyResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('copy')->with([
            'resource_id' => $id,
            'category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'copyResult',
            $config
        )->willReturn($response->copyResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->copy($id, $folderId)
        );
    }

    #[Test]
    public function getListByMandatorIdCanReturnArrayOfResourceInformation(): void
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getAllResult = [
            $object,
            $otherObject
        ];
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAll')->with(['mandator_id' => $id])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getAllResult',
            $config
        )->willReturn($response->getAllResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getListByMandatorId($id)
        );
    }

    #[Test]
    public function getByModificationDateReturnsResult(): void
    {
        $mandator_id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $result = [$object];
        $start = new DateTimeImmutable();
        $end = $start->add(DateInterval::createFromDateString('5 minutes'));

        $response = new stdClass();
        $response->getByModificationDateResult = $result;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getByModificationDate')
            ->with([
                'start_date' => $start->getTimestamp(),
                'end_date' => $end->getTimestamp(),
                'mandator_id' => $mandator_id,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'getByModificationDateResult',
                $config
            )
            ->willReturn($result);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByModificationDate($start, $end, $mandator_id)
        );
    }
}
