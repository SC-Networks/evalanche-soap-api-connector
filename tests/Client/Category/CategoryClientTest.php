<?php

namespace Scn\EvalancheSoapApiConnector\Client\Category;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\CategoryInformationInterface;

/**
 * Class CategoryClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Category
 */
class CategoryClientTest extends TestCase
{
    /**
     * @var CategoryClient
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

    public function setUp()
    {
        $this->soapClient = $this->getWsdlMock([
            'create',
            'delete',
            'getSubCategories'
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new CategoryClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateCanReturnInstanceOfCategoryInformation()
    {
        $title = 'some title';
        $categoryId = 123;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(CategoryInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createCategoryInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('create')->with([
            'name' => $title,
            'parent_category_id' => $categoryId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with($response, 'createResult',
            $config)->willReturn($response->createResult);

        $this->assertInstanceOf(
            CategoryInformationInterface::class,
            $this->subject->create($title, $categoryId)
        );
    }

    public function testDelete()
    {
        $id = 56;

        $response = new \stdClass();
        $response->deleteResult = true;

        $this->soapClient->expects($this->once())->method('delete')->with(['category_id' => $id])->willReturn($response);

        $this->assertNull($this->subject->delete($id));
    }

    public function testGetSubCategoriesCanReturnArrayOfCategoryInformation()
    {
        $id = 523;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(CategoryInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(CategoryInformationInterface::class)->getMock();

        $response = new \stdClass();
        $response->getSubCategoriesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createCategoryInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getSubCategories')->with([
            'category_id' => $id
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with($response, 'getSubCategoriesResult',
            $config)->willReturn($response->getSubCategoriesResult);


        $this->assertContainsOnlyInstancesOf(
            CategoryInformationInterface::class,
            $this->subject->getSubCategories($id)
        );
    }
}
