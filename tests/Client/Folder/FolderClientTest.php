<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Folder;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use stdClass;

/**
 * Class FolderClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Folder
 */
class FolderClientTest extends TestCase
{
    /**
     * @var FolderClient
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
            'create',
            'delete',
            'getSubCategories',
            'getDetails',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new FolderClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateCanReturnInstanceOfFolderInformation()
    {
        $title = 'some title';
        $folderId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FolderInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('create')->with([
            'name' => $title,
            'parent_category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createResult',
            $config
        )->willReturn($response->createResult);

        self::assertInstanceOf(
            FolderInformationInterface::class,
            $this->subject->create($title, $folderId)
        );
    }

    public function testDelete()
    {
        $id = 56;

        $response = new stdClass();
        $response->deleteResult = true;

        $this->soapClient->expects($this->once())
            ->method('delete')
            ->with(['category_id' => $id])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'deleteResult'
            )
            ->willReturn($response->deleteResult);

        $this->assertTrue($this->subject->delete($id));
    }

    public function testGetSubCategoriesCanReturnArrayOfFolderInformation()
    {
        $id = 523;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FolderInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(FolderInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getSubCategoriesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getSubCategories')->with([
            'category_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getSubCategoriesResult',
            $config
        )->willReturn($response->getSubCategoriesResult);


        $this->assertContainsOnlyInstancesOf(
            FolderInformationInterface::class,
            $this->subject->getSubFolderById($id)
        );
    }

    public function testGetCanReturnInstanceOfFolderInformation()
    {
        $id = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FolderInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getDetailsResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createFolderInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getDetails')->with([
            'category_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDetailsResult',
            $config
        )->willReturn($response->getDetailsResult);


        self::assertInstanceOf(
            FolderInformationInterface::class,
            $this->subject->get($id)
        );
    }
}
